<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\PerbaikanPegawai;

class FormPerbaikanController extends Controller
{
    /**
     * Menampilkan form perbaikan.
     */
    public function showForm()
    {
        return view('auth.formperbaikan');
    }

    /**
     * Menyimpan data pengajuan perbaikan.
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $request->validate([
            'tanggalPengajuan' => 'required|date',
            'jenisKerusakan' => 'required|string|max:255',
            'namaBarang' => 'required|string|max:255',
            'keteranganTambahan' => 'nullable|string|max:255',
            'kodeBarang' => 'required|string|max:255',
            'jenisBarang' => 'required|string|max:255',
            'fotoKerusakan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Simpan data ke database
        PerbaikanPegawai::create([
            'user_id' => auth()->id(),
            'tanggal_pengajuan' => $request->tanggalPengajuan,
            'jenis_kerusakan' => $request->jenisKerusakan,
            'nama_barang' => $request->namaBarang,
            'keterangan_tambahan' => $request->keteranganTambahan,
            'kode_barang' => $request->kodeBarang,
            'jenis_barang' => $request->jenisBarang,
            'foto_kerusakan' => $request->file('fotoKerusakan') ? $request->file('fotoKerusakan')->store('uploads') : null,
            'status' => 'Disetujui',
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('dashboard.pegawai')->with('success', 'Pengajuan berhasil! Silakan cek status di Laporan Saya.');
    }
}
