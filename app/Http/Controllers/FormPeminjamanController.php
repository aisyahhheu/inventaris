<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeminjamanPegawai;
use App\Models\Peminjaman;

class FormPeminjamanController extends Controller
{
    public function showForm()
    {
        return view('auth.formpeminjaman');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'namaPegawai' => 'required|string|max:255',
            'timKerja' => 'required|string|max:255',
            'tujuanPeminjaman' => 'required|string|max:255',
            'barangDipinjam' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'tanggalPinjam' => 'required|date',
            'tanggalKembali' => 'required|date|after_or_equal:tanggalPinjam',
        ]);

        // Simpan ke tabel form_peminjaman (pegawai)
        PeminjamanPegawai::create([
            'user_id' => auth()->id(),
            'nama_pegawai' => $validated['namaPegawai'],
            'tim_kerja' => $validated['timKerja'],
            'tujuan_peminjaman' => $validated['tujuanPeminjaman'],
            'barang_yang_ingin_dipinjam' => $validated['barangDipinjam'],
            'jumlah' => $validated['jumlah'],
            'tanggal_pinjam' => $validated['tanggalPinjam'],
            'tanggal_kembali' => $validated['tanggalKembali'],
            'status' => 'Menunggu Persetujuan',
        ]);

        // Simpan ke tabel peminjaman (admin)
        Peminjaman::create([
            'kode_barang' => 'BRG-' . rand(1000, 9999),
            'nama_barang' => $validated['barangDipinjam'],
            'nama_pegawai' => $validated['namaPegawai'],
            'unit_divisi' => $validated['timKerja'],
            'jumlah' => $validated['jumlah'],
            'tgl_pinjam' => $validated['tanggalPinjam'],
            'tgl_kembali' => $validated['tanggalKembali'],
            'status' => 'Dipending',
        ]);

        return redirect()->route('dashboard.pegawai')
            ->with('success', 'Form peminjaman berhasil dikirim dan menunggu persetujuan admin.');
    }
}
