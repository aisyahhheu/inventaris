<?php

namespace App\Http\Controllers;

use App\Models\PengajuanPerbaikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PemeliharaanController extends Controller
{
    /**
     * Menampilkan daftar pengajuan perbaikan dalam bentuk tabel.
     */
    public function showPengajuanPerbaikan()
    {
        // GANTI DENGAN QUERY DATABASE ANDA YANG SESUNGGUHNYA
        try {
            // Mengambil semua data pengajuan dari database, diurutkan berdasarkan ID terbaru
            $dataPengajuan = PengajuanPerbaikan::orderBy('id', 'desc')->get();

        } catch (\Exception $e) {
            // Jika tabel atau Model belum ada, fallback ke array kosong (atau log error)
            $dataPengajuan = [];
            Log::error("Gagal mengambil data Pengajuan Perbaikan: " . $e->getMessage());
        }

        // PASTIKAN FILE INI ADA: resources/views/pemeliharaan/pengajuan_perbaikan.blade.php
        return view('pengajuanperbaikan', [
            'pengajuan' => $dataPengajuan,
        ]);
    }

    /**
     * Menampilkan detail pengajuan perbaikan untuk Modal menggunakan AJAX.
     */
    public function showDetailPerbaikan(Request $request, $id)
    {
        // Cari data detail berdasarkan ID
        $detail = PengajuanPerbaikan::find($id);

        if (!$detail) {
            return response()->json(['error' => 'Data pengajuan tidak ditemukan.'], 404);
        }

        // Memuat view modal dengan data yang ditemukan
        return view('pemeliharaan.modal_detail_perbaikan', ['data' => $detail]);
    }

    // Tambahkan method lain di sini (seperti method untuk Setujui/Tolak)

    /**
     * Method ini hanya sebagai placeholder untuk menu "Pembelian Sparepart"
     */
    public function showPembelianSparepart()
    {
        // Ambil data Pembelian Sparepart dari database
        $dataPembelian = []; // Ganti dengan query database

        return view('pemeliharaan.pembelian_sparepart', [
            'pembelian' => $dataPembelian,
        ]);
    }
}
