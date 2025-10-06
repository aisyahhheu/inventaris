<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardPegawaiController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Hitung jumlah pengajuan perbaikan untuk user
        $countPerbaikan = DB::table('form_perbaikan')->where('user_id', $userId)->count();

        // Hitung jumlah pembelian sparepart untuk user
        $countPembelian = DB::table('form_pembelian_sparepart')->where('user_id', $userId)->count();

        // Hitung jumlah peminjaman aktif (misalnya status 'Disetujui') untuk user
        $countPeminjaman = DB::table('form_peminjaman')->where('user_id', $userId)->count();

        // Total laporan
        $totalLaporan = $countPerbaikan + $countPembelian + $countPeminjaman;

        return view('auth.dashboardpegawai', compact('countPerbaikan', 'countPembelian', 'countPeminjaman', 'totalLaporan'));
    }
}
