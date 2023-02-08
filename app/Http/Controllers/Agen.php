<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Agen extends Controller
{
    /**
     * controller agen
     */

    // index method
    public function index()
    {
        // query data nama transportasi dan akomodasi
        $transportasi = DB::table('transportasi')
            ->select('id_transportasi', 'nama')
            ->get()->all();
        $akomodasi = DB::table('akomodasi_cat')
            ->select('id_akomodasi_cat', 'nama_cat', 'thumbnail')
            ->get()->all();

        // query data peta wisata
        $agen = DB::table('agen_wisata')
            ->select('id_agen_wisata', 'nama', 'no_kontak', 'alamat', 'thumbnail')
            ->get()->all();

        $data = [
            'title_page' => 'Agen Wisata - Website Agen Wisata',
            'akomodasi' => $akomodasi,
            'transportasi' => $transportasi,
            'agen' => $agen
        ];

        return view('user.agen', $data);
    }

    // method untuk detail agen wisata
    public function detail($id_agen_wisata = "")
    {
        // query data nama transportasi dan akomodasi
        $transportasi = DB::table('transportasi')
            ->select('id_transportasi', 'nama')
            ->get()->all();
        $akomodasi = DB::table('akomodasi_cat')
            ->select('id_akomodasi_cat', 'nama_cat', 'thumbnail')
            ->get()->all();

        // query data peta wisata
        $agen = DB::table('agen_wisata')
            ->where('id_agen_wisata', '=', $id_agen_wisata)
            ->get()->first();

        $paket = DB::table('paket')
            ->where('id_agen_wisata', '=', $id_agen_wisata)
            ->get()->all();

        $data = [
            'title_page' => 'Detail Agen Wisata - Website Agen Wisata',
            'akomodasi' => $akomodasi,
            'transportasi' => $transportasi,
            'agen' => $agen,
            'paket' => $paket
        ];

        return view('user.parts.details.agen', $data);
    }

    // method untuk proses cari data
    public function search(Request $request)
    {
        $search_nama = '';
        $query = DB::table('agen_wisata')
            ->select('id_agen_wisata', 'nama', 'no_kontak', 'thumbnail', 'alamat');

        // cari berdasarkan nama agen wisata
        if ($request->input('nama_agen', null)) {
            $search_nama = $request->input('nama_agen');
            $query->where('nama', 'like', "%" . $search_nama . "%");
        }

        // kalau tidak ada pencarian
        if (!$search_nama) {
            return redirect()->route('enduser.agen'); // redirect ke halaman sebelumnya
        }

        // query data nama transportasi, akomodasi, dan kategori akomodasi
        $transportasi = DB::table('transportasi')
            ->select('id_transportasi', 'nama')
            ->get()->all();
        $akomodasi = DB::table('akomodasi_cat')
            ->select('id_akomodasi_cat', 'nama_cat')
            ->get()->all();

        $data = [
            'title_page' => 'Hasil Cari Agen: ' . $search_nama . ' - Website Agen Wisata',
            'bread_main_title' => 'Hasil Cari Agen : ' . $search_nama,
            'transportasi' => $transportasi,
            'akomodasi' => $akomodasi,
            'list' => $query->get()->all(),
            'search_nama' => $search_nama,
        ];

        return view('user.parts.search.agen', $data);
    }

    /**
     * for admin
     */
    public function indexAdmin(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $agen = DB::table('agen_wisata')
            ->select('id_agen_wisata', 'nama', 'alamat', 'thumbnail')
            ->get()->all();

        $data = [
            'login_user' => $request->session()->get('login_user'),
            'agen' => $agen,
        ];

        return view('admin.agen', $data);
    }

    public function detailData(Request $request, $id_agen_wisata = '')
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $detail = DB::table('agen_wisata')
            ->where('id_agen_wisata', '=', $id_agen_wisata)
            ->get()->first();

        $paket = DB::table('paket')
            ->select('id_paket', 'judul', 'harga', 'poster_iklan')
            ->get()->all();

        $data = [
            'login_user' => $request->session()->get('login_user'),
            'detail' => $detail,
            'paket' => $paket,
        ];

        return view('admin.parts.details.agen', $data);
    }

    public function formData(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $data = [
            'login_user' => $request->session()->get('login_user'),
            'title_page' => 'Form Input Data',
            'form_action' => 'admin.agen.create',
        ];

        return view('admin.parts.forms.agen', $data);
    }

    // method create
    public function createData(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        // baca data dan simpan file gambar thumbnail
        $thumbnail = $request->file('thumbnail');
        $path_thumbnail = $thumbnail->store('agen', 'public_upload');

        $data = [
            'nama' => $request->input('nama'),
            'no_kontak' => $request->input('nokontak'),
            'deskripsi' => $request->input('deskripsi'),
            'lokasi' => $request->input('lokasi'),
            'alamat' => $request->input('alamat'),
            'thumbnail' => basename($path_thumbnail),
        ];

        // simpan data di database
        DB::table('agen_wisata')
            ->insert($data);

        return redirect()->route('admin.agen');
    }

    public function editData(Request $request, $id_agen_wisata = '')
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $data = [
            'detail' => DB::table('agen_wisata')->where('id_agen_wisata', '=', $id_agen_wisata)->get()->first(),
            'title_page' => 'Form Edit Data',
            'login_user' => $request->session()->get('login_user'),
            'form_action' => 'admin.agen.update',
        ];

        return view('admin.parts.forms.agen', $data);
    }

    // method update
    public function updateData(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $id_agen_wisata = $request->input('id_agen_wisata');

        $data = [
            'nama' => $request->input('nama'),
            'no_kontak' => $request->input('nokontak'),
            'deskripsi' => $request->input('deskripsi'),
            'alamat' => $request->input('alamat'),
            'lokasi' => $request->input('lokasi'),
        ];

        // query data logo
        $result = DB::table('agen_wisata')
            ->select('thumbnail')
            ->where('id_agen_wisata', '=', $id_agen_wisata)
            ->get()->first();

        // cek jika ada gambar thumbnail baru utk diupload
        if ($request->hasFile('thumbnail')) {
            Storage::disk('public_upload')->delete('agen/' . $result->thumbnail); // hapus filenya

            $thumbnail = $request->file('thumbnail');
            $thumbnail_name = $thumbnail->store('agen', 'public_upload');
            $data['thumbnail'] = basename($thumbnail_name);
        }

        // update data
        DB::table('agen_wisata')
            ->where('id_agen_wisata', '=', $id_agen_wisata)
            ->update($data);

        return redirect()->route('admin.agen.detail', ['id_agen_wisata' => $id_agen_wisata]);
    }

    // method delete
    public function deleteData(Request $request, $id_agen_wisata = '')
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        // query data thumbnail dan galeri
        $data = DB::table('agen_wisata')
            ->select('thumbnail')
            ->where('id_agen_wisata', '=', $id_agen_wisata)
            ->get()->first();

        if (!empty($data->thumbnail)) {
            Storage::disk('public_upload')->delete('agen/' . $data->thumbnail);
        }

        DB::table('agen_wisata')
            ->where('id_agen_wisata', '=', $id_agen_wisata)
            ->delete();

        return redirect()->route('admin.agen');
    }
}
