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
        // Ganti nama view dengan yang sesuai
        return view('auth.formperbaikan');
    }

    /**
     * Menyimpan data pengajuan perbaikan.
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $request->validate([
            'tanggal' => 'required|date',
            'jenisKerusakan' => 'required|string|max:255',
            'namaBarang' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'kodeBarang' => 'required|string|max:255',
            'jenisBarang' => 'required|string|max:255',
            'fotoKerusakan' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Proses upload file foto
        $fotoPath = $request->file('fotoKerusakan')->store('foto-kerusakan', 'public');

        // Simpan data ke database
        PerbaikanPegawai::create([
            'user_id' => auth()->id(),
            'tanggal_pengajuan' => $request->tanggal,
            'jenis_kerusakan' => $request->jenisKerusakan,
            'nama_barang' => $request->namaBarang,
            'keterangan_tambahan' => $request->keterangan,
            'kode_barang' => $request->kodeBarang,
            'jenis_barang' => $request->jenisBarang,
            'foto_kerusakan' => $fotoPath,
            'status' => 'Disetujui',
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('dashboard.pegawai')->with('success', 'Pengajuan berhasil! Silakan cek status di Laporan Saya.');
    }
}
