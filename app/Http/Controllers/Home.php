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
            ->get()->first();

        $data = [
            'login_user' => $request->session()->get('login_user'),
            'homepage' => $homepage
        ];

        return view('admin.homepage', $data);
    }

    // method update
    public function updateData(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $id_data = $request->input('id_data');
        $data = [
            'main_header_title' => $request->input('mainHeaderTitle'),
            'no_kontak' => $request->input('kontak'),
        ];

        DB::table('emergency')
            ->where('id_emergency', '=', $id_emergency)
            ->update($data);

        return redirect()->route('admin.emergency');
    }
}
