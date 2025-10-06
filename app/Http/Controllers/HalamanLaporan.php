<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HalamanLaporan extends Controller
{
    public function index()
    {
        // Mengambil data dari setiap tabel untuk user yang sedang login
        $userId = auth()->id();
        $dataPerbaikan = DB::table('form_perbaikan')->where('user_id', $userId)->get();
        $dataPembelian = DB::table('form_pembelian_sparepart')->where('user_id', $userId)->get();
        $dataPeminjaman = DB::table('form_peminjaman')->where('user_id', $userId)->get();

        return view('auth.halamanlaporan', compact('dataPerbaikan', 'dataPembelian', 'dataPeminjaman'));
    }
}
