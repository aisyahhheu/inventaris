<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardPegawaiController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $countPerbaikan = DB::table('form_perbaikan')
            ->where('user_id', $userId)
            ->count();

        $countPembelian = DB::table('form_pembelian_sparepart')
            ->where('user_id', $userId) 
            ->count();

        $countPeminjaman = DB::table('form_peminjaman')
            ->where('user_id', $userId)
            ->count();

        $totalLaporan = $countPerbaikan + $countPembelian + $countPeminjaman;

        return view('auth.dashboardpegawai', compact(
            'countPerbaikan',
            'countPembelian',
            'countPeminjaman',
            'totalLaporan'
        ));
    }
}