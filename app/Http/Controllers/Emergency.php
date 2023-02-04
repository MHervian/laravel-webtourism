<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Emergency extends Controller
{
    /**
     * controller untuk emergency
     */

    // method index
    public function index()
    {
        // query data nama transportasi dan akomodasi
        $transportasi = DB::table('transportasi')
            ->select('id_transportasi', 'nama')
            ->get()->all();
        $akomodasi = DB::table('akomodasi_cat')
            ->select('id_akomodasi_cat', 'nama_cat', 'thumbnail')
            ->get()->all();

        // query data emergency
        $emergency = DB::table('emergency')
            ->get()->all();

        $data = [
            'title_page' => 'Emergency - Website Agen Wisata',
            'akomodasi' => $akomodasi,
            'transportasi' => $transportasi,
            'emergency' => $emergency
        ];

        return view('user.emergency', $data);
    }

    /**
     * for admin
     */
    public function indexAdmin(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $emergency = DB::table('emergency')
            ->get()->all();

        $data = [
            'login_user' => $request->session()->get('login_user'),
            'emergency' => $emergency
        ];

        return view('admin.emergency', $data);
    }

    public function formData(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $data = [
            'login_user' => $request->session()->get('login_user'),
            'title_page' => 'Form Input Data',
            'form_action' => route('admin.emergency.create'),
        ];

        return view('admin.parts.forms.emergency', $data);
    }

    // method create
    public function createData(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $data = [
            'nama' => $request->input('nama'),
            'no_kontak' => $request->input('kontak'),
        ];

        DB::table('emergency')
            ->insert($data);

        return redirect()->route('admin.emergency');
    }

    public function editData(Request $request, $id_emergency = '')
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $data = [
            'detail' => DB::table('emergency')->where('id_emergency', '=', $id_emergency)->get()->first(),
            'title_page' => 'Form Edit Data',
            'login_user' => $request->session()->get('login_user'),
            'form_action' => route('admin.emergency.update'),
        ];

        return view('admin.parts.forms.emergency', $data);
    }

    // method update
    public function updateData(Request $request)
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');

        $id_emergency = $request->input('id_emergency');
        $data = [
            'nama' => $request->input('nama'),
            'no_kontak' => $request->input('kontak'),
        ];

        DB::table('emergency')
            ->where('id_emergency', '=', $id_emergency)
            ->update($data);

        return redirect()->route('admin.emergency');
    }

    // method delete
    public function deleteData(Request $request, $id_emergency = '')
    {
        if (!$request->session()->exists('login_user'))
            return redirect()->route('admin');
        
        DB::table('emergency')
            ->where('id_emergency', '=', $id_emergency)
            ->delete();

        return redirect()->route('admin.emergency');
    }
}
