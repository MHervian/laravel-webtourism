<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DayaTarik extends Controller
{
    /**
     * daya tarik controller
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

        $dt = DB::table('dt')
            ->select('id_dt', 'id_dt_cat', 'judul', 'thumbnail', 'alamat')
            ->get()->all();

        $dt_cat = DB::table('dt_cat')
            ->select('id_dt_cat', 'nama_dt')
            ->get()->all();

        $data = [
            'title_page' => 'Daya Tarik Wisata - Website Agen Wisata',
            'transportasi' => $transportasi,
            'akomodasi' => $akomodasi,
            'dt' => $dt,
            'dt_cat' => $dt_cat
        ];

        return view('user.dayatarik', $data);
    }

    // menampilkan detail
    public function detail($id_dt = null) {
        // query data nama transportasi dan akomodasi
        $transportasi = DB::table('transportasi')
            ->select('ild_transportasi', 'nama')
            ->get()->al();
        $akomodasi = DB::table('akomodasi_cat')
            ->select('id_akomodasi_cat', 'nama_cat')
            ->get()->all();
        
        $detail = DB::table('dt')
            ->where('id_dt', '=', $id_dt)
            ->get()->first();

        $data = [
            'title_page' => 'Detail Daya Tarik Wisata - Website Agen Wisata',
            'transportasi' => $transportasi,
            'akomodasi' => $akomodasi,
            'detail' => $detail
        ];

        return view('user.parts.details.dayatarik', $data);
    }

    /**
     * for admin
     */
    // ====== aktivitas/daya tarik
    public function indexAdmin(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $dt = DB::table('dt')
            ->select('id_dt', 'id_dt_cat', 'judul', 'deskripsi', 'thumbnail')
            ->get()->all();

        $data = [
            'login_user' => $request->session()->get('login_user'),
            'dt' => $dt,
            'title_page' => 'Daya Tarik/Aktivitas',
        ];

        return view('admin.dayatarik', $data);
    }

    public function detailData(Request $request, $id_dt = '')
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $detail = DB::table('dt')
            ->where('id_dt', '=', $id_dt)
            ->get()->first();

        $data = [
            'login_user' => $request->session()->get('login_user'),
            'detail' => $detail,
            'route_aktivitas' => 'admin.aktivitas',
        ];

        return view('admin.parts.details.dayatarik', $data);
    }

    public function formData(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $kategori = DB::table('dt_cat')
            ->select('id_dt_cat', 'nama_dt')
            ->get()->all();

        $data = [
            'login_user' => $request->session()->get('login_user'),
            'title_page' => 'Form Input Data',
            'title_page_bread' => 'Aktivitas',
            'form_action' => 'admin.aktivitas.create',
            'kategori' => $kategori,
            'route_aktivitas' => 'admin.aktivitas',
        ];

        return view('admin.parts.forms.dayatarik', $data);
    }

    // method create
    public function createData(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        // baca data dan simpan file gambar thumbnail
        $thumbnail = $request->file('thumbnail');
        $path_thumbnail = $thumbnail->store('dt', 'public_upload');

        // baca data, simpan semua file gambar, rangkai menjadi sebuah string
        $galeri = $request->file('galeri');
        $galeri_names = [];
        foreach ($galeri as $g) {
            $path_galeri = $g->store('dt', 'public_upload');
            array_push($galeri_names, basename($path_galeri));
        }

        $data = [
            'judul' => $request->input('nama'),
            'id_dt_cat' => $request->input('kategori'),
            'deskripsi' => $request->input('deskripsi'),
            'alamat' => $request->input('alamat'),
            'lokasi' => $request->input('lokasi'),
            'thumbnail' => basename($path_thumbnail),
            'galeri_src' => join(';', $galeri_names),
        ];

        // simpan data di database
        DB::table('dt')
            ->insert($data);

        return redirect()->route('admin.aktivitas');
    }

    public function editData(Request $request, $id_dt = '')
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $kategori = DB::table('dt_cat')
            ->select('id_dt_cat', 'nama_dt')
            ->get()->all();

        $data = [
            'detail' => DB::table('dt')->where('id_dt', '=', $id_dt)->get()->first(),
            'title_page' => 'Form Edit Data',
            'title_page_bread' => 'Aktivitas/Daya Tarik',
            'login_user' => $request->session()->get('login_user'),
            'form_action' => 'admin.aktivitas.update',
            'kategori' => $kategori,
            'route_aktivitas' => 'admin.aktivitas',
        ];

        return view('admin.parts.forms.dayatarik', $data);
    }

    // update method
    public function updateData(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $id_dt = $request->input('id_dt');

        $data = [
            'judul' => $request->input('nama'),
            'id_dt_cat' => $request->input('kategori'),
            'deskripsi' => $request->input('deskripsi'),
            'alamat' => $request->input('alamat'),
            'lokasi' => $request->input('lokasi'),
        ];

        // query data thumbnail dan galeri
        $result = DB::table('dt')
            ->select('thumbnail', 'galeri_src')
            ->where('id_dt', '=', $id_dt)
            ->get()->first();

        // cek jika ada gambar thumbnail baru utk diupload
        if ($request->hasFile('thumbnail')) {
            Storage::disk('public_upload')->delete('dt/' . $result->thumbnail); // hapus filenya

            $thumbnail = $request->file('thumbnail');
            $thumbnail_name = $thumbnail->store('dt', 'public_upload');
            $data['thumbnail'] = basename($thumbnail_name);
        }

        // cek jika ada galeri baru utk diupload
        if ($request->hasFile(('galeri'))) {
            // hapus semua data
            $galeri_names = explode(';', $result->galeri_src);
            foreach ($galeri_names as $gambar) {
                Storage::disk('public_upload')->delete('dt/' . $gambar);
            }

            $galeri = $request->file('galeri');
            $galeri_names = [];
            foreach ($galeri as $g) {
                $galeri_path = $g->store('dt', 'public_upload');
                array_push($galeri_names, basename($galeri_path));
            }
            $data['galeri_src'] = join(';', $galeri_names);
        }

        // update data
        DB::table('dt')
            ->where('id_dt', '=', $id_dt)
            ->update($data);

        return redirect()->route('admin.aktivitas.detail', ['id_dt' => $id_dt]);
    }

    // delete method
    public function deleteData(Request $request, $id_dt = '')
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');
        
        // query data thumbnail dan galeri
        $data = DB::table('dt')
            ->select('thumbnail', 'galeri_src')
            ->where('id_dt', '=', $id_dt)
            ->get()->first();

        if (!empty($data->thumbnail)) {
            Storage::disk('public_upload')->delete('dt/' . $data->thumbnail);
        }

        if (!empty($data->galeri_src)) {
            $galeri = explode(';', $data->galeri_src);
            foreach ($galeri as $gambar) {
                Storage::disk('public_upload')->delete('dt/' . $gambar);
            }
        }

        DB::table('dt')
            ->where('id_dt', '=', $id_dt)
            ->delete();

        return redirect()->route('admin.aktivitas');
    }

    // ====== kategori aktivitas/daya tarik
    public function indexAdminKategori(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $dt_cat = DB::table('dt_cat')
            ->get()->all();

        $data = [
            'login_user' => $request->session()->get('login_user'),
            'dt_cat' => $dt_cat,
            'title_page' => 'Kategori Daya Tarik',
            'display' => 1,
        ];

        return view('admin.dayatarik', $data);
    }

    public function formDataKategori(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $data = [
            'login_user' => $request->session()->get('login_user'),
            'title_page' => 'Form Input Data',
            'title_page_bread' => 'Kategori Daya Tarik',
            'form_action' => 'admin.aktivitas.kategori.create',
            'display' => 1,
            'route_aktivitas' => 'admin.aktivitas.kategori',
        ];

        return view('admin.parts.forms.dayatarik', $data);
    }

    // method create
    public function createDataKategori(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $data = [
            'nama_dt' => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi'),
        ];

        DB::table('dt_cat')
            ->insert($data);

        return redirect()->route('admin.aktivitas.kategori');
    }

    public function editDataKategori(Request $request, $id_dt_cat = '')
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $data = [
            'detail' => DB::table('dt_cat')->where('id_dt_cat', '=', $id_dt_cat)->get()->first(),
            'title_page' => 'Form Edit Data',
            'title_page_bread' => 'Kategori Daya Tarik/Aktivitas',
            'login_user' => $request->session()->get('login_user'),
            'form_action' => 'admin.aktivitas.kategori.update',
            'display' => 1,
            'route_aktivitas' => 'admin.aktivitas.kategori',
        ];

        return view('admin.parts.forms.dayatarik', $data);
    }

    // method update
    public function updateDataKategori(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $id_dt_cat = $request->input('id_dt_cat');

        $data = [
            'nama_dt' => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi'),
        ];

        DB::table('dt_cat')
            ->where('id_dt_cat', '=', $id_dt_cat)
            ->update($data);

        return redirect()->route('admin.aktivitas.kategori');
    }

    // method delete
    public function deleteDataKategori(Request $request, $id_dt_cat = '')
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        DB::table('dt_cat')
            ->where('id_dt_cat', '=', $id_dt_cat)->delete();

        return redirect()->route('admin.aktivitas.kategori');
    }
}
