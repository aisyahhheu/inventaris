<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanPegawai; // Model yang terhubung ke tabel form_peminjaman
use App\Models\Asset;            // Asumsi Model Asset sudah ada
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class PeminjamanPimpinanController extends Controller
{
    /**
     * Mengambil data ringkasan dan daftar permohonan peminjaman.
     */
    public function peminjamanIndex()
    {
        // 1. Data untuk Kartu (Cards)
        $totalAset = Asset::count(); 
        $totalPeminjaman = PeminjamanPegawai::where('status', 'Disetujui')->count(); // Peminjaman yang disetujui
        $pengajuanBaru = PeminjamanPegawai::where('status', 'Pending')->count(); // Pengajuan yang menunggu (Pending)
        
        // Asumsi Total Maintenance, ganti dengan logika nyata jika ada
        $totalMaintenance = 10; 

        // 2. Data untuk Tabel (Daftar Permohonan)
        $daftarPeminjaman = PeminjamanPegawai::orderBy('created_at', 'desc')->get();

        // 3. Kirim data ke View Blade
        return view('pimpinan.peminjamanpimpinan', compact(
            'totalAset',
            'totalPeminjaman',
            'totalMaintenance',
            'pengajuanBaru',
            'daftarPeminjaman'
        ));
    }

    /**
     * Menampilkan detail permohonan berdasarkan ID.
     */
    public function detail($id)
    {
        $data = PeminjamanPegawai::findOrFail($id); 
        // Sesuaikan nama view ini jika Anda menggunakan modal/halaman detail yang berbeda
        return view('pimpinan.peminjaman_detail', compact('data')); 
    }
}