<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    // 1. Menampilkan Halaman Utama Laporan
    public function index()
    {
        return view('laporanadmin'); // Mengarah ke file yang kita buat di atas
    }

    // 2. Data Seluruh Aset
    public function dataAset()
    {
        // Logika query data aset...
        return view('laporan.detail.data_aset');
    }

    // 3. Barang Masuk
    public function barangMasuk()
    {
        // Logika query barang masuk...
        return view('laporan.detail.barang_masuk');
    }
    
    // 4. Barang Keluar / Peminjaman
    public function barangKeluar()
    {
        // Logika query barang keluar/peminjaman...
        return view('laporan.detail.barang_keluar');
    }

    // 5. Pengajuan Perbaikan
    public function pengajuanPerbaikan()
    {
        // Logika query pengajuan perbaikan...
        return view('laporan.detail.pengajuan_perbaikan');
    }

    // 6. Pembelian Sparepart
    public function pembelianSparepart()
    {
        // Logika query pembelian sparepart...
        return view('laporan.detail.pembelian_sparepart');
    }

    // 7. Ringkasan & Analisis
    public function ringkasan()
    {
        // Logika query dan persiapan data statistik/grafik...
        return view('laporan.detail.ringkasan');
    }
}