<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\PeminjamanPegawai;

class FormPeminjamanController extends Controller
{
    /**
     * Menampilkan form peminjaman.
     */
    public function showForm()
    {
        return view('auth.formpeminjaman');
    }

    /**
     * Menyimpan data pengajuan peminjaman.
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $request->validate([
            'namaPegawai' => 'required|string|max:255',
            'timKerja' => 'required|string|max:255',
            'tujuanPeminjaman' => 'required|string|max:255',
            'barangDipinjam' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'tanggalPinjam' => 'required|date',
            'tanggalKembali' => 'required|date|after_or_equal:tanggalPinjam',
        ]);

        // Simpan data ke database
        PeminjamanPegawai::create([
            'user_id' => auth()->id(),
            'nama_pegawai' => $request->namaPegawai,
            'tim_kerja' => $request->timKerja,
            'tujuan_peminjaman' => $request->tujuanPeminjaman,
            'barang_yang_ingin_dipinjam' => $request->barangDipinjam,
            'jumlah' => $request->jumlah,
            'tanggal_pinjam' => $request->tanggalPinjam,
            'tanggal_kembali' => $request->tanggalKembali,
            'status' => 'Disetujui',
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('dashboard.pegawai')->with('success', 'Pengajuan berhasil! Silakan cek status di Laporan Saya.');
    }
}
