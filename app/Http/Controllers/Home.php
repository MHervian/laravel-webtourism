<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
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
            'peta_wisata' => $peta_wisata,
            'paket' => $paket
        ];

        return view('user.homepage', $data);
    }
}
