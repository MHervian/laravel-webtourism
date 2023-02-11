<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Kalender extends Controller
{
    /**
     * kalender event controller
     */

    // main index
    public function index()
    {
        // query data nama transportasi dan akomodasi
        $transportasi = DB::table('transportasi')
            ->select('id_transportasi', 'nama')
            ->get()->all();
        $akomodasi = DB::table('akomodasi_cat')
            ->select('id_akomodasi_cat', 'nama_cat')
            ->get()->all();

        // query data event/kalender    
        $kalender = DB::table('kalender')
            ->select('id_kalender', 'id_kalender_cat', 'judul', 'thumbnail')
            ->get()->all();

        $kalender_cat = DB::table('kalender_cat')
            ->select('id_kalender_cat', 'nama_cat')
            ->get()->all();

        $data = [
            'title_page' => 'Kalender - Web Agen Wisata',
            'transportasi' => $transportasi,
            'akomodasi' => $akomodasi,
            'kalender' => $kalender,
            'kalender_cat' => $kalender_cat
        ];

        return view('user.kalender', $data);
    }

    // detail kalender/event
    public function detail($id_kalender = null)
    {
        // query data nama transportasi dan akomodasi
        $transportasi = DB::table('transportasi')
            ->select('id_transportasi', 'nama')
            ->get()->all();
        $akomodasi = DB::table('akomodasi_cat')
            ->select('id_akomodasi_cat', 'nama_cat')
            ->get()->all();

        // query data event/kalender    
        $detail = DB::table('kalender')
            ->where('id_kalender', '=', $id_kalender)
            ->get()->first();

        $kalender_cat = DB::table('kalender_cat')
            ->select('id_kalender_cat', 'nama_cat')
            ->get()->all();

        $data = [
            'title_page' => 'Kalender - Web Agen Wisata',
            'transportasi' => $transportasi,
            'akomodasi' => $akomodasi,
            'detail' => $detail,
            'kalender_cat' => $kalender_cat
        ];

        return view('user.parts.details.kalender', $data);
    }

    // method pencarian 
    public function search(Request $request, $id_kategori_cat = null)
    {
        $query = DB::table('kalender')
            ->select('id_kalender', 'id_kalender_cat', 'judul', 'thumbnail');

        // query data nama transportasi, akomodasi, dan kategori kalender
        $transportasi = DB::table('transportasi')
            ->select('id_transportasi', 'nama')
            ->get()->all();
        $akomodasi = DB::table('akomodasi_cat')
            ->select('id_akomodasi_cat', 'nama_cat')
            ->get()->all();
        $kategori_kalender = DB::table('kalender_cat')
            ->select('id_kalender_cat', 'nama_cat')
            ->get()->all();

        // pencarian menggunakan link kategori
        if ($id_kategori_cat) {
            $kategori = array_filter($kategori_kalender, function ($kategori) use ($id_kategori_cat) {
                return $kategori->id_kalender_cat == intval($id_kategori_cat);
            });
            $kategori = array_pop($kategori);

            $data = [
                'title_page' => 'List Kalender/Event dengan Kategori: ' . $kategori->nama_cat . ' - Website Agen Wisata',
                'bread_main_title' => 'List Kalender/Event dengan Kategori: ' . $kategori->nama_cat,
                'transportasi' => $transportasi,
                'akomodasi' => $akomodasi,
                'kategori_kalender' => $kategori_kalender,
                'list' => $query->where('id_kalender', '=', $id_kategori_cat)->get()->all(),
                'id_kategori' => $query->where('id_kalender_cat', '=', $id_kategori_cat)->get()->all(),
                'nama_kategori' => $kategori->nama_cat,
                'display' => true,
            ];
        } else { // pencarian dengan menggunakan form
            $id_kategori_kalender = '';
            $nama_kalender = '';

            // cari berdasarkan kategori kalender/event
            if ($request->input('id_kategori_kalender', null)) {
                $id_kategori_kalender = $request->input('id_kategori_kalender');
                $query->where('id_kalender_cat', '=', $id_kategori_kalender);
            }

            // cari berdasarkan nama kalender/event
            if ($request->input('nama_kalender', null)) {
                $nama_kalender = $request->input('nama_kalender');
                $query->where('judul', 'like', "%" . $nama_kalender . "%");
            }

            // kalau tidak ada pencarian
            if (!$id_kategori_kalender && !$nama_kalender) {
                return redirect()->route('enduser.kalender'); // redirect ke halaman sebelumnya
            }

            $data = [
                'title_page' => 'Cari Kalender/Event dengan Nama: ' . $nama_kalender . ' - Website Agen Wisata',
                'bread_main_title' => 'Cari Kalender/Event dengan Nama: ' . $nama_kalender,
                'transportasi' => $transportasi,
                'akomodasi' => $akomodasi,
                'kategori_kalender' => $kategori_kalender,
                'list' => $query->get()->all(),
                'nama_kalender' => $nama_kalender,
            ];

            // jika dicari menggunakan kategori kalender
            if ($id_kategori_kalender) {
                $kategori = array_filter($kategori_kalender, function ($kategori) use ($id_kategori_kalender) {
                    return $kategori->id_kalender_cat == intval($id_kategori_kalender);
                });
                $kategori = array_pop($kategori);
                $data['title_page'] = 'Cari Kalender/Event dengan Kategori: ' . $kategori->nama_cat . ' - Website Agen Wisata';
                $data['bread_main_title'] = 'Cari Kalender/Event dengan Kategori: ' . $kategori->nama_cat;
                $data['id_kategori'] = $kategori->id_kalender_cat;
                $data['nama_kategori'] = $kategori->nama_cat;
            }
        }

        return view('user.parts.search.kalender', $data);
    }

    /**
     * for admin
     */
    // ====== kalender
    public function indexAdmin(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $kalender = DB::table('kalender')
            ->select('id_kalender', 'judul', 'thumbnail')
            ->get()->all();

        $data = [
            'login_user' => $request->session()->get('login_user'),
            'kalender' => $kalender,
            'title_page' => 'Kalender',
        ];

        return view('admin.kalender', $data);
    }

    public function detailData(Request $request, $id_kalender = '')
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $detail = DB::table('kalender')
            ->where('id_kalender', '=', $id_kalender)
            ->get()->first();

        $data = [
            'login_user' => $request->session()->get('login_user'),
            'detail' => $detail,
            'route_kalender' => 'admin.kalender',
        ];

        return view('admin.parts.details.kalender', $data);
    }

    public function formData(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $kategori = DB::table('kalender_cat')
            ->select('id_kalender_cat', 'nama_cat')
            ->get()->all();

        $data = [
            'login_user' => $request->session()->get('login_user'),
            'title_page' => 'Form Input Data',
            'title_page_bread' => 'Kalender',
            'form_action' => 'admin.kalender.create',
            'kategori' => $kategori,
            'route_kalender' => 'admin.kalender',
        ];

        return view('admin.parts.forms.kalender', $data);
    }

    // method create
    public function createData(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        // baca data dan simpan file gambar thumbnail
        $thumbnail = $request->file('thumbnail');
        $path_thumbnail = $thumbnail->store('kalender', 'public_upload');

        $data = [
            'judul' => $request->input('nama'),
            'id_kalender_cat' => $request->input('kategori'),
            'deskripsi' => $request->input('deskripsi'),
            'thumbnail' => basename($path_thumbnail),
        ];

        // simpan data di database
        DB::table('kalender')
            ->insert($data);

        return redirect()->route('admin.kalender');
    }

    public function editData(Request $request, $id_kalender = '')
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $kategori = DB::table('kalender_cat')
            ->select('id_kalender_cat', 'nama_cat')
            ->get()->all();

        $data = [
            'detail' => DB::table('kalender')->where('id_kalender', '=', $id_kalender)->get()->first(),
            'title_page' => 'Form Edit Data',
            'title_page_bread' => 'Kalender',
            'login_user' => $request->session()->get('login_user'),
            'form_action' => 'admin.kalender.update',
            'kategori' => $kategori,
            'route_kalender' => 'admin.kalender',
        ];

        return view('admin.parts.forms.kalender', $data);
    }

    // update method
    public function updateData(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $id_kalender = $request->input('id_kalender');

        $data = [
            'judul' => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi'),
            'id_kalender_cat' => $request->input('kategori'),
        ];

        // query data thumbnail
        $result = DB::table('kalender')
            ->select('thumbnail')
            ->where('id_kalender', '=', $id_kalender)
            ->get()->first();

        // cek jika ada gambar thumbnail baru utk diupload
        if ($request->hasFile('thumbnail')) {
            Storage::disk('public_upload')->delete('kalender/' . $result->thumbnail); // hapus filenya

            $thumbnail = $request->file('thumbnail');
            $thumbnail_name = $thumbnail->store('kalender', 'public_upload');
            $data['thumbnail'] = basename($thumbnail_name);
        }

        // update data
        DB::table('kalender')
            ->where('id_kalender', '=', $id_kalender)
            ->update($data);

        return redirect()->route('admin.kalender.detail', ['id_kalender' => $id_kalender]);
    }

    // delete method
    public function deleteData(Request $request, $id_kalender = '')
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        // query data thumbnail dan galeri
        $data = DB::table('kalender')
            ->select('thumbnail')
            ->where('id_kalender', '=', $id_kalender)
            ->get()->first();

        if (!empty($data->thumbnail)) {
            Storage::disk('public_upload')->delete('kalender/' . $data->thumbnail);
        }

        DB::table('kalender')
            ->where('id_kalender', '=', $id_kalender)
            ->delete();

        return redirect()->route('admin.kalender');
    }

    // ====== kategori kalender
    public function indexAdminKategori(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $kalender_cat = DB::table('kalender_cat')
            ->get()->all();

        $data = [
            'login_user' => $request->session()->get('login_user'),
            'kalender' => $kalender_cat,
            'title_page' => 'Kategori Kalender',
            'display' => 1,
        ];

        return view('admin.kalender', $data);
    }

    public function formDataKategori(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $data = [
            'login_user' => $request->session()->get('login_user'),
            'title_page' => 'Form Input Data',
            'title_page_bread' => 'Kategori Kalender',
            'form_action' => 'admin.kalender.kategori.create',
            'display' => 1,
            'route_kalender' => 'admin.kalender.kategori',
        ];

        return view('admin.parts.forms.kalender', $data);
    }

    // method create
    public function createDataKategori(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $data = [
            'nama_cat' => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi'),
        ];

        DB::table('kalender_cat')
            ->insert($data);

        return redirect()->route('admin.kalender.kategori');
    }

    public function editDataKategori(Request $request, $id_kalender_cat = '')
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $data = [
            'detail' => DB::table('kalender_cat')->where('id_kalender_cat', '=', $id_kalender_cat)->get()->first(),
            'title_page' => 'Form Edit Data',
            'title_page_bread' => 'Kategori Kalender',
            'login_user' => $request->session()->get('login_user'),
            'form_action' => 'admin.kalender.kategori.update',
            'display' => 1,
            'route_kalender' => 'admin.kalender.kategori',
        ];

        return view('admin.parts.forms.kalender', $data);
    }

    // method update
    public function updateDataKategori(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $id_kalender_cat = $request->input('id_kalender_cat');

        $data = [
            'nama_cat' => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi'),
        ];

        DB::table('kalender_cat')
            ->where('id_kalender_cat', '=', $id_kalender_cat)
            ->update($data);

        return redirect()->route('admin.kalender.kategori');
    }

    // method delete
    public function deleteDataKategori(Request $request, $id_kalender_cat = '')
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        // hapus data - data yang berelasi dengan kalender
        DB::table('kalender')
            ->where('id_kalender_cat', '=', $id_kalender_cat)->delete();

        DB::table('kalender_cat')
            ->where('id_kalender_cat', '=', $id_kalender_cat)->delete();

        return redirect()->route('admin.kalender.kategori');
    }
}
