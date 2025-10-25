<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('dashboard');
            } elseif ($user->role === 'pegawai') {
                return redirect()->route('dashboard.pegawai');
            } elseif ($user->role === 'pimpinan') {
                return redirect()->route('dashboardpimpinan'); 
            }

            // kalau role tidak dikenali
            Auth::logout();
            return redirect('/login')->withErrors([
                'email' => 'Role pengguna tidak dikenali.',
            ]);
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }
}
