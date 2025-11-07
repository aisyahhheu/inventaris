<?php

namespace App\Http\Controllers;

use App\Models\PengajuanPerbaikan;
use App\Models\PerbaikanPegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FormPerbaikanController extends Controller
{
    /**
     * Tampilkan form pengajuan perbaikan.
     */
    public function create()
    {
        return view('auth.formperbaikan');
    }

    /**
     * Simpan pengajuan perbaikan dari pegawai, lalu kirim ke admin.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_pengajuan'   => 'required|date',
            'jenis_kerusakan'     => 'required|string|max:255',
            'nama_barang'         => 'required|string|max:255',
            'kode_barang'         => 'required|string|max:255',
            'jenis_barang'        => 'required|string|max:255',
            'keterangan_tambahan' => 'nullable|string',
            'foto_kerusakan'      => 'nullable|image|max:2048',
        ]);

        try {
            // Upload foto jika ada
            $fotoPath = null;
            if ($request->hasFile('foto_kerusakan')) {
                $fotoPath = $request->file('foto_kerusakan')->store('kerusakan', 'public');
            }

            // ✅ Simpan ke tabel perbaikan_pegawai
            $pegawaiForm = PerbaikanPegawai::create([
                'user_id'             => auth()->id(),
                'tanggal_pengajuan'   => $validated['tanggal_pengajuan'],
                'jenis_kerusakan'     => $validated['jenis_kerusakan'],
                'nama_barang'         => $validated['nama_barang'],
                'kode_barang'         => $validated['kode_barang'],
                'jenis_barang'        => $validated['jenis_barang'],
                'keterangan_tambahan' => $validated['keterangan_tambahan'] ?? null,
                'foto_kerusakan'      => $fotoPath,
                'status'              => 'Dipending',
            ]);

            // ✅ Simpan ke tabel pengajuan_perbaikan (admin)
            PengajuanPerbaikan::create([
                'user_id'             => auth()->id(),
                'asset_id'            => null,
                'kode_barang'         => $pegawaiForm->kode_barang,
                'nama_barang'         => $pegawaiForm->nama_barang,
                'jenis_barang'        => $pegawaiForm->jenis_barang, // ⬅ tambahkan ini agar sesuai form
                'jenis_kerusakan'     => $pegawaiForm->jenis_kerusakan,
                'keterangan_tambahan' => $pegawaiForm->keterangan_tambahan,
                'foto_kerusakan_path' => $fotoPath,
                'tgl_pengajuan'       => $pegawaiForm->tanggal_pengajuan,
                'status'              => 'Dipending',
            ]);

            return redirect()->route('dashboard.pegawai')
                ->with('success', 'Pengajuan perbaikan berhasil dikirim ke admin.');

        } catch (\Exception $e) {
            Log::error('Gagal menyimpan pengajuan perbaikan: ' . $e->getMessage());
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
