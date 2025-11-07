<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Asset; // ✅ perbaiki di sini (tanpa 's')
use App\Models\Peminjaman;
use App\Models\Maintenance;
use App\Models\PerbaikanPegawai as Pengajuan;

class DashboardPimpinanController extends Controller
{
    public function index()
    {
        // Total jumlah unit dari kolom 'jumlah' pada tabel data_aset
        $jumlah_aset = Asset::sum('jumlah');

        // Statistik tambahan
        $totalPeminjaman = Peminjaman::where('status', 'Dipinjam')->count();
        $totalMaintenance = Maintenance::where('status', 'Proses')->count();
        $totalPengajuanBaru = Pengajuan::where('status', 'Baru')->count();

        $grafikData = [
            'peminjaman' => [8, 5, 9, 6, 4, 7],
            'perbaikan'  => [4, 2, 5, 3, 1, 2],
            'labels'     => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni']
        ];

        $infoAset = Asset::limit(3)->get();
        $aktivitasTerbaru = Peminjaman::orderBy('created_at', 'desc')->take(5)->get();
        $latest_aset = Asset::latest()->limit(10)->get();

        return view('dashboardpimpinan', compact(
            'jumlah_aset',
            'totalPeminjaman',
            'totalMaintenance',
            'totalPengajuanBaru',
            'grafikData',
            'infoAset',
            'aktivitasTerbaru',
            'latest_aset'
        ));
    }
}
