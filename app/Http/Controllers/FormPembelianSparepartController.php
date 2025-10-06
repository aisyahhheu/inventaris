<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\PembelianSparepartPegawai;

class FormPembelianSparepartController extends Controller
{
    /**
     * Menampilkan form pembelian sparepart.
     */
    public function showForm()
    {
        // Ganti nama view dengan yang sesuai
        return view('auth.formpembeliansparepart');
    }

    /**
     * Menyimpan data pengajuan pembelian sparepart.
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $request->validate([
            'tanggal' => 'required|date',
            'namaSparepart' => 'required|string|max:255',
            'kodeBarangTerkait' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'alasanPengajuan' => 'nullable|string',
            'fotoKerusakan' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Proses upload file foto
        $fotoPath = $request->file('fotoKerusakan')->store('foto-kerusakan', 'public');

        // Simpan data ke database
        PembelianSparepartPegawai::create([
            'user_id' => auth()->id(),
            'tanggal_pengajuan' => $request->tanggal,
            'nama_sparepart' => $request->namaSparepart,
            'kode_barang_terkait' => $request->kodeBarangTerkait,
            'jumlah' => $request->jumlah,
            'alasan_pengajuan' => $request->alasanPengajuan,
            'foto_kerusakan' => $fotoPath,
            'status' => 'Disetujui',
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('dashboard.pegawai')->with('success', 'Pengajuan berhasil! Silakan cek status di Laporan Saya.');
    }
}
