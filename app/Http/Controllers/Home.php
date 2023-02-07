<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Home extends Controller
{
    /**
     * untuk homepage end-user
     */

    public function index()
    {
        // query data nama transportasi dan akomodasi
        $transportasi = DB::table('transportasi')
            ->select('id_transportasi', 'nama')
            ->get()->all();
        $akomodasi = DB::table('akomodasi_cat')
            ->select('id_akomodasi_cat', 'nama_cat', 'thumbnail')
            ->get()->all();
        
        // query data homepage
        $homepage = DB::table('home_content')
            ->where('id_content', '=', 1)
            ->get()->first();

        // query data peta wisata
        $peta_wisata = DB::table('wisata')
            ->select('id_wisata', 'id_wisata_cat', 'judul', 'alamat', 'thumbnail')
            ->limit(4)
            ->get()->all();

        $paket = DB::table('paket')
            ->select('id_paket', 'judul', 'harga', 'poster_iklan')
            ->limit(4)
            ->get()->all();

        $data = [
            'title_page' => 'Beranda - Website Agen Wisata',
            'akomodasi' => $akomodasi,
            'transportasi' => $transportasi,
            'homepage' => $homepage,
            'peta_wisata' => $peta_wisata,
            'paket' => $paket,
        ];

        return view('user.homepage', $data);
    }

    /**
     * for admin
     */
    // homepage edit
    public function indexAdmin(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $homepage = DB::table('home_content')
            ->where('id_content', '=', 1)
            ->get()->first();

        $data = [
            'login_user' => $request->session()->get('login_user'),
            'detail' => $homepage
        ];

        return view('admin.homepage', $data);
    }

    // method update
    public function updateData(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $id_content = $request->input('id_content');
        $data = [
            'main_title' => $request->input('main_title', null),
            'desc_main' => $request->input('desc_main', null),
            'title_paket' => $request->input('title_paket', null),
            'desc_paket' => $request->input('desc_paket', null),
            'title_peta' => $request->input('title_peta', null),
            'desc_peta' => $request->input('desc_peta', null),
            'title_daya_tarik' => $request->input('title_daya_tarik', null),
            'desc_daya_tarik' => $request->input('desc_daya_tarik', null),
            'title_transportasi' => $request->input('title_transportasi', null),
            'desc_transportasi' => $request->input('desc_transportasi', null),
            'title_akomodasi' => $request->input('title_akomodasi', null),
            'desc_akomodasi' => $request->input('desc_akomodasi', null),
        ];

        DB::table('home_content')
            ->where('id_content', '=', $id_content)
            ->update($data);

        return redirect()->route('admin.edithomepage');
    }
}
