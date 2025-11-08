<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\PembelianSparepartPegawai;
use App\Models\PengajuanSparepart; // ⬅️ Tambah model admin
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class FormPembelianSparepartController extends Controller
{
    /**
     * Menampilkan form pembelian sparepart.
     */
    public function showForm()
    {
        return view('auth.formpembeliansparepart');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggalPengajuan' => 'required|date',
            'namaSparepart' => 'required|string|max:255',
            'kodeBarangTerkait' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'alasanPengajuan' => 'required|string|max:255',
            'fotoKerusakan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoPath = $request->hasFile('fotoKerusakan')
            ? $request->file('fotoKerusakan')->store('uploads', 'public')
            : null;

        // Simpan ke tabel pegawai
        PembelianSparepartPegawai::create([
            'user_id' => auth()->id(),
            'tanggal_pengajuan' => $validated['tanggalPengajuan'],
            'nama_sparepart' => $validated['namaSparepart'],
            'kode_barang_terkait' => $validated['kodeBarangTerkait'],
            'jumlah' => $validated['jumlah'],
            'alasan_pengajuan' => $validated['alasanPengajuan'],
            'foto_kerusakan' => $fotoPath,
            'status' => 'Pending',
        ]);

        // Simpan juga ke tabel admin
        PengajuanSparepart::create([
            'nama_sparepart'    => $validated['namaSparepart'],
            'kode_barang'       => $validated['kodeBarangTerkait'],
            'jumlah'            => $validated['jumlah'],
            'alasan_pengajuan'  => $validated['alasanPengajuan'],
            'tanggal_pengajuan' => $validated['tanggalPengajuan'],
            'foto_kerusakan'    => $fotoPath,
            'nama_pegawai'      => auth()->user()->name ?? 'Pegawai',
            'status'            => 'Dipending',
        ]);

        return redirect()->route('dashboard.pegawai')->with('success', 'Pengajuan berhasil disimpan.');
    }
}
