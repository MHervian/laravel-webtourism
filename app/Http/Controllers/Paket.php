<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Paket extends Controller
{
    /**
     * paket controller
     */

    // main index
    public function index() {
        // query data nama transportasi dan akomodasi
        $transportasi = DB::table('transportasi')
            ->select('id_transportasi', 'nama')
            ->get()->all();
        $akomodasi = DB::table('akomodasi_cat')
            ->select('id_akomodasi_cat', 'nama_cat')
            ->get()->all();

        // data semua paket wisata
        $paket = DB::table('paket')
            ->get()->all();
        
        // data semua agen wisata
        $agen = DB::table('agen_wisata')
            ->select('id_agen_wisata', 'nama')
            ->get()->all();

        $data = [
            'title_page' => 'Paket Wisata - Web Agen Wisata',
            'transportasi' => $transportasi,
            'akomodasi' => $akomodasi,
            'paket' => $paket,
            'agen' => $agen
        ];

        return view('user.paket', $data);
    }

    // detail paket
    public function detail($id_paket = "") {
        // query data nama transportasi dan akomodasi
        $transportasi = DB::table('transportasi')
            ->select('id_transportasi', 'nama')
            ->get()->all();
        $akomodasi = DB::table('akomodasi_cat')
            ->select('id_akomodasi_cat', 'nama_cat')
            ->get()->all();
        
        // query data paket wisata
        $paket = DB::table('paket')
            ->where('id_paket', '=', $id_paket)
            ->get()->first();
        
        $destinasi = DB::table('destinasi')
            ->select('wisata.id_wisata', 'wisata.judul', 'wisata.thumbnail', 'wisata.alamat')
            ->join('wisata', 'wisata.id_wisata', '=', 'destinasi.id_wisata')
            ->where('destinasi.id_paket', '=', $id_paket)
            ->get()->all();
        
        $data = [
            'title_page' => 'Detail Paket Wisata - Web Agen Wisata',
            'transportasi' => $transportasi,
            'akomodasi' => $akomodasi,
            'paket' => $paket,
            'destinasi' => $destinasi
        ];

        return view('user.parts.details.paket', $data);
    }

    /**
     * for admin
     */
    // ====== paket wisata
    public function indexAdmin(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $paket = DB::table('paket')
            ->select('id_paket', 'judul', 'poster_iklan')
            ->get()->all();

        $data = [
            'login_user' => $request->session()->get('login_user'),
            'paket' => $paket,
        ];

        return view('admin.paket', $data);
    }

    public function detailData(Request $request, $id_paket = '')
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $detail = DB::table('paket')
            ->where('id_paket', '=', $id_paket)
            ->get()->first();

        $agen = DB::table('agen_wisata')
            ->where('id_agen_wisata', '=', $detail->id_agen_wisata)
            ->get()->first();

        $data = [
            'login_user' => $request->session()->get('login_user'),
            'detail' => $detail,
            'agen' => $agen,
        ];

        return view('admin.parts.details.paket', $data);
    }

    public function formData(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $agen = DB::table('agen_wisata')
            ->select('id_agen_wisata', 'nama')
            ->get()->all();

        $data = [
            'login_user' => $request->session()->get('login_user'),
            'title_page' => 'Form Input Data',
            'form_action' => 'admin.paket.create',
            'kategori' => $agen,
            'route_paket' => 'admin.paket',
        ];

        return view('admin.parts.forms.paket', $data);
    }

    // method create
    public function createData(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        // baca data dan simpan file gambar thumbnail
        $thumbnail = $request->file('thumbnail');
        $path_thumbnail = $thumbnail->store('paket', 'public_upload');

        $data = [
            'judul' => $request->input('nama'),
            'subjudul' => $request->input('nama_sub'),
            'harga' => $request->input('harga'),
            'durasi' => $request->input('durasi'),
            'deskripsi' => $request->input('deskripsi'),
            'id_agen_wisata' => $request->input('kategori'),
            'poster_iklan' => basename($path_thumbnail),
        ];

        // simpan data di database
        DB::table('paket')
            ->insert($data);

        return redirect()->route('admin.paket');
    }

    public function editData(Request $request, $id_paket = '')
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $agen = DB::table('agen_wisata')
            ->select('id_agen_wisata', 'nama')
            ->get()->all();

        $data = [
            'detail' => DB::table('paket')->where('id_paket', '=', $id_paket)->get()->first(),
            'title_page' => 'Form Edit Data',
            'login_user' => $request->session()->get('login_user'),
            'form_action' => 'admin.paket.update',
            'kategori' => $agen,
        ];

        return view('admin.parts.forms.paket', $data);
    }

    // update method
    public function updateData(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $id_paket = $request->input('id_paket');

        $data = [
            'judul' => $request->input('nama'),
            'subjudul' => $request->input('nama_sub'),
            'harga' => $request->input('harga'),
            'durasi' => $request->input('durasi'),
            'deskripsi' => $request->input('deskripsi'),
            'id_agen_wisata' => $request->input('kategori'),
        ];

        // query data thumbnail dan galeri
        $result = DB::table('paket')
            ->select('poster_iklan')
            ->where('id_paket', '=', $id_paket)
            ->get()->first();

        // cek jika ada gambar thumbnail baru utk diupload
        if ($request->hasFile('thumbnail')) {
            Storage::disk('public_upload')->delete('paket/' . $result->poster_iklan); // hapus filenya

            $thumbnail = $request->file('thumbnail');
            $thumbnail_name = $thumbnail->store('paket', 'public_upload');
            $data['poster_iklan'] = basename($thumbnail_name);
        }

        // update data
        DB::table('paket')
            ->where('id_paket', '=', $id_paket)
            ->update($data);

        return redirect()->route('admin.paket.detail', ['id_paket' => $id_paket]);
    }

    // delete method
    public function deleteData(Request $request, $id_paket = '')
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');
        
        // query data thumbnail
        $data = DB::table('paket')
            ->select('poster_iklan')
            ->where('id_paket', '=', $id_paket)
            ->get()->first();

        if (!empty($data->poster_iklan)) {
            Storage::disk('public_upload')->delete('paket/' . $data->poster_iklan);
        }

        DB::table('paket')
            ->where('id_paket', '=', $id_paket)
            ->delete();

        return redirect()->route('admin.paket');
    }
}
