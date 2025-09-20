<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // Fungsi untuk menampilkan formulir registrasi
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Fungsi untuk memproses data registrasi
    public function register(Request $request)
    {
        // 1. Validasi data dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // 2. Buat user baru di database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 3. Alihkan pengguna ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('status', 'Pendaftaran berhasil! Silakan login dengan akun Anda.');
    }
}