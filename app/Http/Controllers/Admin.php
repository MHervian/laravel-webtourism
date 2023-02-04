<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Admin extends Controller
{
    /**
     * Admin controller
     */

    // main index function
    public function index(Request $request) {
        if ($request->session()->exists('login_user')) 
            return redirect()->route('admin.dashboard');

        return view('admin.login');
    }

    // login function
    public function login(Request $request) {
        $username = $request->input('username', null);
        $password = $request->input('password', null);

        $result = DB::table('pengguna')
            ->where('nama_user', '=', $username)
            ->where('pass', '=', $password)
            ->get()->first();

        if ($result !== null) {
            // store in session
            $request->session()->put('login_user', $result->nama_user);

            return redirect()->route('admin.dashboard');
        }
        
        return redirect()->route('admin', ['status' => 'fail login']);
    }

    // logout function
    public function logout(Request $request) {
        $request->session()->flush();
        return redirect()->route('admin', ['status'=> 'logout' ]);
    }

    // dashboard function
    public function dashboard(Request $request) {
        if (!$request->session()->exists('login_user')) 
            return redirect()->route('admin');

        $data = [
            'login_user' => $request->session()->get('login_user')
        ];
        return view('admin.dashboard', $data);
    }
}
