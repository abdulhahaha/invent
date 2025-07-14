<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('auth.login');
    }
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba autentikasi
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect sesuai role (opsional)
            switch (Auth::user()->role) {
                case 1:
                    return redirect()->route('inbound.index')->with('success','Selamat datang Inbound');
                case 2:
                    return redirect()->route('invent.index')->with('success','Selamat datang Inbound');
                case 3:
                    return redirect()->route('outbound.index')->with('success','Selamat datang Inbound');
                case 4:
                    return redirect()->route('supervisor.index')->with('success','Selamat datang Inbound');
                default:
                    return redirect()->route('login')->with('error','Username atau passwprd salah');
            }
        }

        // Gagal login
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
