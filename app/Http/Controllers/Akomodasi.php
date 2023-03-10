<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Akomodasi extends Controller
{
    /**
     * akomodasi controller
     */

    // halaman utama akomodasi
    public function index($id_akomodasi_cat = null)
    {
        // query data nama transportasi dan akomodasi
        $transportasi = DB::table('transportasi')
            ->select('id_transportasi', 'nama')
            ->get()->all();
        $akomodasi = DB::table('akomodasi_cat')
            ->select('id_akomodasi_cat', 'nama_cat')
            ->get()->all();
        $kategori_akomodasi = DB::table('akomodasi_cat')
            ->select('id_akomodasi_cat', 'nama_cat')
            ->get()->all();

        // query list data-data akomodasi
        $list = DB::table('akomodasi')
            ->select('id_akomodasi', 'akomodasi.id_akomodasi_cat', 'judul', 'akomodasi.thumbnail', 'alamat', 'nama_cat')
            ->join('akomodasi_cat', 'akomodasi_cat.id_akomodasi_cat', '=', 'akomodasi.id_akomodasi_cat')
            ->where('akomodasi.id_akomodasi_cat', '=', $id_akomodasi_cat)
            ->get()->all();

        // ambil data nama kategori akomodasi
        $kategori = array_filter($kategori_akomodasi, function ($kategori) use ($id_akomodasi_cat) {
            return $kategori->id_akomodasi_cat == intval($id_akomodasi_cat);
        });
        $kategori = array_pop($kategori);

        $data = [
            'title_page' => 'List Akomodasi ' . $kategori->nama_cat . ' - Website Agen Wisata',
            'transportasi' => $transportasi,
            'akomodasi' => $akomodasi,
            'kategori_akomodasi' => $kategori_akomodasi,
            'list' => $list,
            'id_kategori' => $id_akomodasi_cat,
            'nama_kategori' => $kategori->nama_cat,
        ];

        return view('user.akomodasi', $data);
    }

    // method untuk detail akomodasi lanjut
    public function detail(Request $request, $id_akomodasi_cat = null, $id_akomodasi = null)
    {
        $kategori = $request->query('kategori', null);

        // query data nama transportasi dan akomodasi
        $transportasi = DB::table('transportasi')
            ->select('id_transportasi', 'nama')
            ->get()->all();
        $akomodasi = DB::table('akomodasi_cat')
            ->select('id_akomodasi_cat', 'nama_cat')
            ->get()->all();

        // query detail akomodasi
        $detail = DB::table('akomodasi')
            ->where('id_akomodasi', '=', $id_akomodasi)
            ->get()->first();

        $data = [
            'title_page' => 'Detail Akomodasi - Website Agen Wisata',
            'transportasi' => $transportasi,
            'akomodasi' => $akomodasi,
            'detail' => $detail,
            'id_kategori' => $id_akomodasi_cat,
            'nama_kategori' => $kategori,
        ];

        return view('user.parts.details.akomodasi', $data);
    }

    public function search(Request $request)
    {
        // mendapatakan referer dari header request masuk
        $path = explode('/', $request->headers->get('referer'));
        $id_akomodasi_cat = array_pop($path);

        $search_kategori = '';
        $search_nama = '';
        $query = DB::table('akomodasi')
            ->select('id_akomodasi', 'akomodasi.id_akomodasi_cat', 'judul', 'akomodasi.thumbnail', 'alamat', 'nama_cat')
            ->join('akomodasi_cat', 'akomodasi_cat.id_akomodasi_cat', '=', 'akomodasi.id_akomodasi_cat');

        // cari berdasarkan kategori akomodasi
        if ($request->input('kategori', null)) {
            $search_kategori = $request->input('kategori');
            $query->where('akomodasi.id_akomodasi_cat', '=', $search_kategori);
        }

        // cari berdasarkan nama akomodasi
        if ($request->input('nama_akomodasi', null)) {
            $search_nama = $request->input('nama_akomodasi');
            $query->where('judul', 'like', "%" . $search_nama . "%");
        }

        // kalau tidak ada pencarian
        if (!$search_kategori && !$search_nama) {
            return redirect()->route('enduser.akomodasi', ['id_akomodasi_cat' => $id_akomodasi_cat]); // redirect ke halaman sebelumnya
        }

        // query data nama transportasi, akomodasi, dan kategori akomodasi
        $transportasi = DB::table('transportasi')
            ->select('id_transportasi', 'nama')
            ->get()->all();
        $akomodasi = DB::table('akomodasi_cat')
            ->select('id_akomodasi_cat', 'nama_cat')
            ->get()->all();
        $kategori_akomodasi = DB::table('akomodasi_cat')
            ->select('id_akomodasi_cat', 'nama_cat')
            ->get()->all();

        $data = [
            'title_page' => 'Cari Berdasarkan Nama: ' . $search_nama . ' - Website Agen Wisata',
            'bread_main_title' => 'Cari Berdasarkan Nama : ' . $search_nama,
            'transportasi' => $transportasi,
            'akomodasi' => $akomodasi,
            'kategori_akomodasi' => $kategori_akomodasi,
            'list' => $query->get()->all(),
            'nama_kategori' => '',
            'search_nama' => $search_nama,
        ];

        // jika dicari menggunakan kategori akomodasi
        if ($search_kategori) {
            $kategori = array_filter($kategori_akomodasi, function ($kategori) use ($search_kategori) {
                return $kategori->id_akomodasi_cat == intval($search_kategori);
            });
            $kategori = array_pop($kategori);
            $data['title_page'] = 'Cari Berdasarkan Kategori: ' . $kategori->nama_cat . ' - Website Agen Wisata';
            $data['bread_main_title'] = 'Cari Berdasarkan Kategori: ' . $kategori->nama_cat;
            $data['id_kategori'] = $kategori->id_akomodasi_cat;
            $data['nama_kategori'] = $kategori->nama_cat;
        }

        return view('user.parts.search.akomodasi', $data);
    }

    /**
     * for admin
     */
    // ====== akomodasi
    public function indexAdmin(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $akomodasi = DB::table('akomodasi')
            ->select('id_akomodasi', 'id_akomodasi_cat', 'judul', 'thumbnail')
            ->get()->all();

        $data = [
            'login_user' => $request->session()->get('login_user'),
            'akomodasi' => $akomodasi,
            'title_page' => 'Akomodasi',
        ];

        return view('admin.akomodasi', $data);
    }

    public function detailData(Request $request, $id_akomodasi = '')
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $detail = DB::table('akomodasi')
            ->where('id_akomodasi', '=', $id_akomodasi)
            ->get()->first();

        $data = [
            'login_user' => $request->session()->get('login_user'),
            'detail' => $detail,
            'route_akomodasi' => 'admin.akomodasi',
        ];

        return view('admin.parts.details.akomodasi', $data);
    }

    public function formData(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $kategori = DB::table('akomodasi_cat')
            ->select('id_akomodasi_cat', 'nama_cat')
            ->get()->all();

        $data = [
            'login_user' => $request->session()->get('login_user'),
            'title_page' => 'Form Input Data',
            'title_page_bread' => 'Akomodasi',
            'form_action' => route('admin.akomodasi.create'),
            'kategori' => $kategori,
            'route_akomodasi' => 'admin.akomodasi',
        ];

        return view('admin.parts.forms.akomodasi', $data);
    }

    // method create
    public function createData(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        // baca data dan simpan file gambar thumbnail
        $thumbnail = $request->file('thumbnail');
        $path_thumbnail = $thumbnail->store('akomodasi', 'public_upload');

        // baca data, simpan semua file gambar, rangkai menjadi sebuah string
        $galeri = $request->file('galeri');
        $galeri_names = [];
        foreach ($galeri as $g) {
            $path_galeri = $g->store('akomodasi', 'public_upload');
            array_push($galeri_names, basename($path_galeri));
        }

        $data = [
            'judul' => $request->input('nama'),
            'id_akomodasi_cat' => $request->input('kategori'),
            'deskripsi' => $request->input('deskripsi'),
            'alamat' => $request->input('alamat'),
            'lokasi' => $request->input('lokasi'),
            'thumbnail' => basename($path_thumbnail),
            'galeri_src' => join(';', $galeri_names),
        ];

        // simpan data di database
        DB::table('akomodasi')
            ->insert($data);

        return redirect()->route('admin.akomodasi');
    }

    public function editData(Request $request, $id_akomodasi = '')
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $kategori = DB::table('akomodasi_cat')
            ->select('id_akomodasi_cat', 'nama_cat')
            ->get()->all();

        $data = [
            'detail' => DB::table('akomodasi')->where('id_akomodasi', '=', $id_akomodasi)->get()->first(),
            'title_page' => 'Form Edit Data',
            'title_page_bread' => 'Akomodasi',
            'login_user' => $request->session()->get('login_user'),
            'form_action' => route('admin.akomodasi.update'),
            'kategori' => $kategori,
            'route_akomodasi' => 'admin.akomodasi',
        ];

        return view('admin.parts.forms.akomodasi', $data);
    }

    // update method
    public function updateData(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $id_akomodasi = $request->input('id_akomodasi');

        $data = [
            'judul' => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi'),
            'alamat' => $request->input('alamat'),
            'lokasi' => $request->input('lokasi'),
            'id_akomodasi_cat' => $request->input('kategori'),
        ];

        // query data thumbnail dan galeri
        $result = DB::table('akomodasi')
            ->select('thumbnail', 'galeri_src')
            ->where('id_akomodasi', '=', $id_akomodasi)
            ->get()->first();

        // cek jika ada gambar thumbnail baru utk diupload
        if ($request->hasFile('thumbnail')) {
            Storage::disk('public_upload')->delete('akomodasi/' . $result->thumbnail); // hapus filenya

            $thumbnail = $request->file('thumbnail');
            $thumbnail_name = $thumbnail->store('akomodasi', 'public_upload');
            $data['thumbnail'] = basename($thumbnail_name);
        }

        // cek jika ada galeri baru utk diupload
        if ($request->hasFile(('galeri'))) {
            // hapus semua data
            $galeri_names = explode(';', $result->galeri_src);
            foreach ($galeri_names as $gambar) {
                Storage::disk('public_upload')->delete('akomodasi/' . $gambar);
            }

            $galeri = $request->file('galeri');
            $galeri_names = [];
            foreach ($galeri as $g) {
                $galeri_path = $g->store('akomodasi', 'public_upload');
                array_push($galeri_names, basename($galeri_path));
            }
            $data['galeri_src'] = join(';', $galeri_names);
        }

        // update data
        DB::table('akomodasi')
            ->where('id_akomodasi', '=', $id_akomodasi)
            ->update($data);

        return redirect()->route('admin.akomodasi.detail', ['id_akomodasi' => $id_akomodasi]);
    }

    // delete method
    public function deleteData(Request $request, $id_akomodasi = '')
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        // query data thumbnail dan galeri
        $data = DB::table('akomodasi')
            ->select('thumbnail', 'galeri_src')
            ->where('id_akomodasi', '=', $id_akomodasi)
            ->get()->first();

        if (!empty($data->thumbnail)) {
            Storage::disk('public_upload')->delete('akomodasi/' . $data->thumbnail);
        }

        if (!empty($data->galeri_src)) {
            $galeri = explode(';', $data->galeri_src);
            foreach ($galeri as $gambar) {
                Storage::disk('public_upload')->delete('akomodasi/' . $gambar);
            }
        }

        DB::table('akomodasi')
            ->where('id_akomodasi', '=', $id_akomodasi)
            ->delete();

        return redirect()->route('admin.akomodasi');
    }

    // ====== kategori akomodasi
    public function indexAdminKategori(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $akomodasi_cat = DB::table('akomodasi_cat')
            ->get()->all();

        $data = [
            'login_user' => $request->session()->get('login_user'),
            'akomodasi' => $akomodasi_cat,
            'title_page' => 'Kategori Akomodasi',
            'display' => 1,
        ];

        return view('admin.akomodasi', $data);
    }

    public function formDataKategori(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $data = [
            'login_user' => $request->session()->get('login_user'),
            'title_page' => 'Form Input Data',
            'title_page_bread' => 'Kategori Akomodasi',
            'form_action' => route('admin.akomodasi.kategori.create'),
            'display' => 1,
            'route_akomodasi' => 'admin.akomodasi.kategori',
        ];

        return view('admin.parts.forms.akomodasi', $data);
    }

    // method create
    public function createDataKategori(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        // baca data dan simpan file gambar thumbnail
        $thumbnail = $request->file('thumbnail');
        $path_thumbnail = $thumbnail->store('akomodasi', 'public_upload');

        $data = [
            'nama_cat' => $request->input('nama'),
            'jenis' => $request->input('jenis', 'umum'),
            'deskripsi' => $request->input('deskripsi'),
            'thumbnail' => basename($path_thumbnail),
        ];

        DB::table('akomodasi_cat')
            ->insert($data);

        return redirect()->route('admin.akomodasi.kategori');
    }

    public function editDataKategori(Request $request, $id_akomodasi_cat = '')
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $data = [
            'detail' => DB::table('akomodasi_cat')->where('id_akomodasi_cat', '=', $id_akomodasi_cat)->get()->first(),
            'title_page' => 'Form Edit Data',
            'title_page_bread' => 'Kategori Akomodasi',
            'login_user' => $request->session()->get('login_user'),
            'form_action' => route('admin.akomodasi.kategori.update'),
            'display' => 1,
            'route_akomodasi' => 'admin.akomodasi.kategori',
        ];

        return view('admin.parts.forms.akomodasi', $data);
    }

    // method update
    public function updateDataKategori(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $id_akomodasi_cat = $request->input('id_akomodasi_cat');

        $data = [
            'nama_cat' => $request->input('nama'),
            'jenis' => $request->input('jenis'),
            'deskripsi' => $request->input('deskripsi'),
        ];

        $result = DB::table('akomodasi_cat')
            ->select('thumbnail')
            ->where('id_akomodasi_cat', '=', $id_akomodasi_cat)
            ->get()->first();

        // cek apakah upload gambar baru
        if ($request->hasFile('thumbnail')) {
            Storage::disk('public_upload')->delete('akomodasi/' . $result->thumbnail);

            $thumbnail_path = $request->file('thumbnail')->store('akomodasi', 'public_upload');
            $data['thumbnail'] = basename($thumbnail_path);
        }

        DB::table('akomodasi_cat')
            ->where('id_akomodasi_cat', '=', $id_akomodasi_cat)
            ->update($data);

        return redirect()->route('admin.akomodasi.kategori');
    }

    // method delete
    public function deleteDataKategori(Request $request, $id_akomodasi_cat = '')
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        // query data thumbnail
        $result = DB::table('akomodasi_cat')
            ->select('thumbnail')
            ->where('id_akomodasi_cat', '=', $id_akomodasi_cat)
            ->get()->first();

        Storage::disk('public_upload')->delete('akomodasi/' . $result->thumbnail);

        DB::table('akomodasi_cat')
            ->where('id_akomodasi_cat', '=', $id_akomodasi_cat)->delete();

        return redirect()->route('admin.akomodasi.kategori');
    }
}
