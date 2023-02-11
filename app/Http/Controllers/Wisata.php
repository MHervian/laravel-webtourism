<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Wisata extends Controller
{
    /**
     * peta wisata controller
     */

    // method utama
    public function index()
    {
        // query data nama transportasi dan akomodasi
        $transportasi = DB::table('transportasi')
            ->select('id_transportasi', 'nama')
            ->get()->all();
        $akomodasi = DB::table('akomodasi_cat')
            ->select('id_akomodasi_cat', 'nama_cat')
            ->get()->all();

        $wisata = DB::table('wisata')
            ->select('id_wisata', 'id_wisata_cat', 'judul', 'alamat', 'thumbnail')
            ->get()->all();

        $wilayah_wisata = DB::table('wisata_cat')
            ->get()->all();

        $data = [
            'title_page' => 'Informasi Peta Wisata - Website Agen Wisata',
            'transportasi' => $transportasi,
            'akomodasi' => $akomodasi,
            'wisata' => $wisata,
            'wilayah_wisata' => $wilayah_wisata
        ];

        return view('user.wisata', $data);
    }

    // method detail wisata
    public function detail($id_wisata = null)
    {
        // query data nama transportasi dan akomodasi
        $transportasi = DB::table('transportasi')
            ->select('id_transportasi', 'nama')
            ->get()->all();
        $akomodasi = DB::table('akomodasi_cat')
            ->select('id_akomodasi_cat', 'nama_cat')
            ->get()->all();

        $detail = DB::table('wisata')
            ->where('id_wisata', '=', $id_wisata)
            ->get()->first();

        $data = [
            'title_page' => 'Detail Wisata - Website Agen Wisata',
            'transportasi' => $transportasi,
            'akomodasi' => $akomodasi,
            'detail' => $detail
        ];

        return view('user.parts.details.wisata', $data);
    }

    // public method pencarian 
    public function search(Request $request)
    {
        $kategori_peta = '';
        $nama_peta = '';
        $query = DB::table('wisata')
            ->select('id_wisata', 'id_wisata_cat', 'judul', 'thumbnail', 'alamat');

        // cari berdasarkan kategori akomodasi
        if ($request->input('kategori_peta', null)) {
            $kategori_peta = $request->input('kategori_peta');
            $query->where('id_wisata_cat', '=', $kategori_peta);
        }

        // cari berdasarkan nama akomodasi
        if ($request->input('nama_peta', null)) {
            $nama_peta = $request->input('nama_peta');
            $query->where('judul', 'like', "%" . $nama_peta . "%");
        }

        // kalau tidak ada pencarian
        if (!$kategori_peta && !$nama_peta) {
            return redirect()->route('enduser.petawisata'); // redirect ke halaman sebelumnya
        }

        // query data nama transportasi, akomodasi, dan kategori akomodasi
        $transportasi = DB::table('transportasi')
            ->select('id_transportasi', 'nama')
            ->get()->all();
        $akomodasi = DB::table('akomodasi_cat')
            ->select('id_akomodasi_cat', 'nama_cat')
            ->get()->all();
        $wilayah_wisata = DB::table('wisata_cat')
            ->select('id_wisata_cat', 'kecamatan')
            ->get()->all();

        $data = [
            'title_page' => 'Cari Destinasi dengan Nama: ' . $nama_peta . ' - Website Agen Wisata',
            'bread_main_title' => 'Cari Destinasi dengan Nama : ' . $nama_peta,
            'transportasi' => $transportasi,
            'akomodasi' => $akomodasi,
            'wilayah_wisata' => $wilayah_wisata,
            'list' => $query->get()->all(),
            'search_nama' => $nama_peta,
        ];

        // jika dicari menggunakan kategori akomodasi
        if ($kategori_peta) {
            $kategori = array_filter($wilayah_wisata, function ($kategori) use ($kategori_peta) {
                return $kategori->id_wisata_cat == intval($kategori_peta);
            });
            $kategori = array_pop($kategori);
            $data['title_page'] = 'Destinasi di Wilayah: ' . $kategori->kecamatan . ' - Website Agen Wisata';
            $data['bread_main_title'] = 'Destinasi di Wilayah: ' . $kategori->kecamatan;
            $data['id_kategori'] = $kategori->id_wisata_cat;
            $data['nama_kategori'] = $kategori->kecamatan;
        }

        return view('user.parts.search.wisata', $data);
    }

    /**
     * for admin
     */
    // ====== wisata
    public function indexAdmin(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $wisata = DB::table('wisata')
            ->select('id_wisata', 'judul', 'thumbnail', 'alamat',)
            ->get()->all();

        $data = [
            'login_user' => $request->session()->get('login_user'),
            'wisata' => $wisata,
            'title_page' => 'Wisata',
        ];

        return view('admin.wisata', $data);
    }

    public function detailData(Request $request, $id_wisata = '')
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $detail = DB::table('wisata')
            ->where('id_wisata', '=', $id_wisata)
            ->get()->first();

        $data = [
            'login_user' => $request->session()->get('login_user'),
            'detail' => $detail,
        ];

        return view('admin.parts.details.wisata', $data);
    }

    public function formData(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $kategori = DB::table('wisata_cat')
            ->select('id_wisata_cat', 'kecamatan')
            ->get()->all();

        $data = [
            'login_user' => $request->session()->get('login_user'),
            'title_page' => 'Form Input Data',
            'title_page_bread' => 'wisata',
            'form_action' => 'admin.wisata.create',
            'kategori' => $kategori,
            'route_wisata' => 'admin.wisata',
        ];

        return view('admin.parts.forms.wisata', $data);
    }

    // method create
    public function createData(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        // baca data dan simpan file gambar thumbnail
        $thumbnail = $request->file('thumbnail');
        $path_thumbnail = $thumbnail->store('wisata', 'public_upload');

        // baca data, simpan semua file gambar, rangkai menjadi sebuah string
        $galeri = $request->file('galeri');
        $galeri_names = [];
        foreach ($galeri as $g) {
            $path_galeri = $g->store('wisata', 'public_upload');
            array_push($galeri_names, basename($path_galeri));
        }

        $data = [
            'judul' => $request->input('nama'),
            'id_wisata_cat' => $request->input('kategori'),
            'deskripsi' => $request->input('deskripsi'),
            'alamat' => $request->input('alamat'),
            'lokasi' => $request->input('lokasi'),
            'thumbnail' => basename($path_thumbnail),
            'galeri_src' => join(';', $galeri_names),
        ];

        // simpan data di database
        DB::table('wisata')
            ->insert($data);

        return redirect()->route('admin.wisata');
    }

    public function editData(Request $request, $id_wisata = '')
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $kategori = DB::table('wisata_cat')
            ->select('id_wisata_cat', 'kecamatan')
            ->get()->all();

        $data = [
            'detail' => DB::table('wisata')->where('id_wisata', '=', $id_wisata)->get()->first(),
            'title_page' => 'Form Edit Data',
            'title_page_bread' => 'Wisata',
            'login_user' => $request->session()->get('login_user'),
            'form_action' => 'admin.wisata.update',
            'kategori' => $kategori,
            'route_wisata' => 'admin.wisata',
        ];

        return view('admin.parts.forms.wisata', $data);
    }

    // update method
    public function updateData(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $id_wisata = $request->input('id_wisata');

        $data = [
            'judul' => $request->input('nama'),
            'id_wisata_cat' => $request->input('kategori'),
            'deskripsi' => $request->input('deskripsi'),
            'alamat' => $request->input('alamat'),
            'lokasi' => $request->input('lokasi'),
        ];

        // query data thumbnail dan galeri
        $result = DB::table('wisata')
            ->select('thumbnail', 'galeri_src')
            ->where('id_wisata', '=', $id_wisata)
            ->get()->first();

        // cek jika ada gambar thumbnail baru utk diupload
        if ($request->hasFile('thumbnail')) {
            Storage::disk('public_upload')->delete('wisata/' . $result->thumbnail); // hapus filenya

            $thumbnail = $request->file('thumbnail');
            $thumbnail_name = $thumbnail->store('wisata', 'public_upload');
            $data['thumbnail'] = basename($thumbnail_name);
        }

        // cek jika ada galeri baru utk diupload
        if ($request->hasFile(('galeri'))) {
            // hapus semua data
            $galeri_names = explode(';', $result->galeri_src);
            foreach ($galeri_names as $gambar) {
                Storage::disk('public_upload')->delete('wisata/' . $gambar);
            }

            $galeri = $request->file('galeri');
            $galeri_names = [];
            foreach ($galeri as $g) {
                $galeri_path = $g->store('wisata', 'public_upload');
                array_push($galeri_names, basename($galeri_path));
            }
            $data['galeri_src'] = join(';', $galeri_names);
        }

        // update data
        DB::table('wisata')
            ->where('id_wisata', '=', $id_wisata)
            ->update($data);

        return redirect()->route('admin.wisata.detail', ['id_wisata' => $id_wisata]);
    }

    // delete method
    public function deleteData(Request $request, $id_wisata = '')
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        // query data thumbnail dan galeri
        $data = DB::table('wisata')
            ->select('thumbnail', 'galeri_src')
            ->where('id_wisata', '=', $id_wisata)
            ->get()->first();

        if (!empty($data->thumbnail)) {
            Storage::disk('public_upload')->delete('wisata/' . $data->thumbnail);
        }

        if (!empty($data->galeri_src)) {
            $galeri = explode(';', $data->galeri_src);
            foreach ($galeri as $gambar) {
                Storage::disk('public_upload')->delete('wisata/' . $gambar);
            }
        }

        DB::table('wisata')
            ->where('id_wisata', '=', $id_wisata)
            ->delete();

        return redirect()->route('admin.wisata');
    }

    // ====== kategori akomodasi
    public function indexAdminKategori(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $wisata_cat = DB::table('wisata_cat')
            ->get()->all();

        $data = [
            'login_user' => $request->session()->get('login_user'),
            'wisata' => $wisata_cat,
            'title_page' => 'Kategori Wisata',
            'display' => 1,
        ];

        return view('admin.wisata', $data);
    }

    public function formDataKategori(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $data = [
            'login_user' => $request->session()->get('login_user'),
            'title_page' => 'Form Input Data',
            'title_page_bread' => 'Kategori Wisata',
            'form_action' => 'admin.wisata.kategori.create',
            'display' => 1,
            'route_wisata' => 'admin.wisata.kategori',
        ];

        return view('admin.parts.forms.wisata', $data);
    }

    // method create
    public function createDataKategori(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $data = [
            'kecamatan' => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi'),
        ];

        DB::table('wisata_cat')
            ->insert($data);

        return redirect()->route('admin.wisata.kategori');
    }

    public function editDataKategori(Request $request, $id_wisata_cat = '')
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $data = [
            'detail' => DB::table('wisata_cat')->where('id_wisata_cat', '=', $id_wisata_cat)->get()->first(),
            'title_page' => 'Form Edit Data',
            'title_page_bread' => 'Kategori Wisata',
            'login_user' => $request->session()->get('login_user'),
            'form_action' => 'admin.wisata.kategori.update',
            'display' => 1,
            'route_wisata' => 'admin.wisata.kategori',
        ];

        return view('admin.parts.forms.wisata', $data);
    }

    // method update
    public function updateDataKategori(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $id_wisata_cat = $request->input('id_wisata_cat');

        $data = [
            'kecamatan' => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi'),
        ];

        DB::table('wisata_cat')
            ->where('id_wisata_cat', '=', $id_wisata_cat)
            ->update($data);

        return redirect()->route('admin.wisata.kategori');
    }

    // method delete
    public function deleteDataKategori(Request $request, $id_wisata_cat = '')
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        DB::table('wisata_cat')
            ->where('id_wisata_cat', '=', $id_wisata_cat)->delete();

        return redirect()->route('admin.wisata.kategori');
    }
}
