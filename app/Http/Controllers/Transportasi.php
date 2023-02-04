<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Transportasi extends Controller
{
    /**
     * Untuk halaman transportasi dan detailnya
     */

    public function index($id_transportasi = "")
    {
        // query data nama transportasi dan akomodasi
        $transportasi = DB::table('transportasi')
            ->select('id_transportasi', 'nama')
            ->get()->all();
        $akomodasi = DB::table('akomodasi_cat')
            ->select('id_akomodasi_cat', 'nama_cat')
            ->get()->all();

        // query informasi detail transportasi
        $detail = DB::table('transportasi')
            ->where('id_transportasi', '=', $id_transportasi)
            ->get()->first();

        $data = [
            'title_page' => 'Informasi ' . $detail->nama . ' - Website Agen Wisata',
            'transportasi' => $transportasi,
            'akomodasi' => $akomodasi,
            'detail' => $detail
        ];

        return view('user.transportasi', $data);
    }

    /** 
     * For admin */
    public function indexAdmin(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $transportasi = DB::table('transportasi')
            ->select('id_transportasi', 'nama', 'alamat')
            ->get()->all();

        $data = [
            'login_user' => $request->session()->get('login_user'),
            'transportasi' => $transportasi
        ];

        return view('admin.transportasi', $data);
    }

    public function detailData(Request $request, $id_transportasi = null)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $detail = DB::table('transportasi')
            ->where('id_transportasi', '=', $id_transportasi)
            ->get()->first();

        $data = [
            'login_user' => $request->session()->get('login_user'),
            'detail' => $detail
        ];

        return view('admin.parts.details.transportasi', $data);
    }

    public function formData(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $data = [
            'login_user' => $request->session()->get('login_user'),
            'title_page' => 'Form Input Data',
            'form_action' => route('admin.transportasi.create'),
        ];

        return view('admin.parts.forms.transportasi', $data);
    }

    // method create
    public function createData(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        // baca data dan simpan file gambar thumbnail
        $thumbnail = $request->file('thumbnail');
        $path_thumbnail = $thumbnail->store('transportasi', 'public_upload');

        // baca data, simpan semua file gambar, rangkai menjadi sebuah string
        $galeri = $request->file('galeri');
        $galeri_names = [];
        foreach ($galeri as $g) {
            $path_galeri = $g->store('transportasi', 'public_upload');
            array_push($galeri_names, basename($path_galeri));
        }

        $data = [
            'nama' => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi'),
            'alamat' => $request->input('alamat'),
            'lokasi' => $request->input('lokasi'),
            'thumbnail' => basename($path_thumbnail),
            'galeri_src' => join(';', $galeri_names),
        ];

        // simpan data di database
        DB::table('transportasi')
            ->insert($data);

        return redirect()->route('admin.transportasi');
    }

    public function editData(Request $request, $id_transportasi = '')
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $data = [
            'detail' => DB::table('transportasi')->where('id_transportasi', '=', $id_transportasi)->get()->first(),
            'title_page' => 'Form Edit Data',
            'login_user' => $request->session()->get('login_user'),
            'form_action' => route('admin.transportasi.update'),
        ];

        return view('admin.parts.forms.transportasi', $data);
    }

    public function updateData(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $id_transportasi = $request->input('id_transportasi');

        $data = [
            'nama' => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi'),
            'alamat' => $request->input('alamat'),
            'lokasi' => $request->input('lokasi'),
        ];

        // query data thumbnail dan galeri
        $result = DB::table('transportasi')
            ->select('thumbnail', 'galeri_src')
            ->where('id_transportasi', '=', $id_transportasi)
            ->get()->first();

        // cek jika ada gambar thumbnail baru utk diupload
        if ($request->hasFile('thumbnail')) {
            Storage::disk('public_upload')->delete('transportasi/' . $result->thumbnail); // hapus filenya

            $thumbnail = $request->file('thumbnail');
            $thumbnail_name = $thumbnail->store('transportasi', 'public_upload');
            $data['thumbnail'] = basename($thumbnail_name);
        }

        // cek jika ada galeri baru utk diupload
        if ($request->hasFile(('galeri'))) {
            // hapus semua data
            $galeri_names = explode(';', $result->galeri_src);
            foreach ($galeri_names as $gambar) {
                Storage::disk('public_upload')->delete('transportasi/' . $gambar);
            }

            $galeri = $request->file('galeri');
            $galeri_names = [];
            foreach ($galeri as $g) {
                $galeri_path = $g->store('transportasi', 'public_upload');
                array_push($galeri_names, basename($galeri_path));
            }
            $data['galeri_src'] = join(';', $galeri_names);
        }

        // update data
        DB::table('transportasi')
            ->where('id_transportasi', '=', $id_transportasi)
            ->update($data);

        return redirect()->route('admin.transportasi.detail', ['id_transportasi' => $id_transportasi]);
    }

    public function deleteData(Request $request, $id_transportasi = '')
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        // query data thumbnail dan galeri
        $data = DB::table('transportasi')
            ->select('thumbnail', 'galeri_src')
            ->where('id_transportasi', '=', $id_transportasi)
            ->get()->first();

        if (!empty($data->thumbnail)) {
            Storage::disk('public_upload')->delete('transportasi/' . $data->thumbnail);
        }

        if (!empty($data->galeri_src)) {
            $galeri = explode(';', $data->galeri_src);
            foreach ($galeri as $gambar) {
                Storage::disk('public_upload')->delete('transportasi/' . $gambar);
            }
        }

        DB::table('transportasi')
            ->where('id_transportasi', '=', $id_transportasi)
            ->delete();

        return redirect()->route('admin.transportasi');
    }
}
