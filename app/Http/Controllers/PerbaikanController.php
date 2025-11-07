<?php

namespace App\Http\Controllers;

use App\Models\PengajuanPerbaikan;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class PerbaikanController extends Controller
{
    /**
     * Menampilkan semua data pengajuan perbaikan (Admin)
     */
    public function index()
    {
        $pengajuan = PengajuanPerbaikan::orderBy('tgl_pengajuan', 'desc')->get();
        return view('pengajuan-perbaikan', compact('pengajuan'));
    }

    /**
     * Menampilkan detail pengajuan perbaikan (Admin)
     */
    public function detail($id)
    {
        $perbaikan = PengajuanPerbaikan::findOrFail($id);
        return view('detail_perbaikan', compact('perbaikan'));
    }

    /**
     * Update status pengajuan perbaikan (Disetujui / Ditolak / Dipending / Selesai)
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required|in:Disetujui,Ditolak,Dipending,Selesai',
            ]);

            $perbaikan = PengajuanPerbaikan::findOrFail($id);
            $perbaikan->status = $request->status;
            $perbaikan->save();

            if ($request->ajax()) {
                return response()->json(['message' => 'Status berhasil diubah menjadi ' . $request->status]);
            }

            return redirect()->route('perbaikan.index')->with('success', 'Status berhasil diperbarui.');
        } catch (QueryException $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui status: ' . $e->getMessage());
        }
    }

    /**
     * Menyimpan pengajuan perbaikan dari pegawai ke tabel admin
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'asset_id'             => 'nullable|integer',
                'kode_barang'          => 'required|string|max:100',
                'nama_barang'          => 'required|string|max:255',
                'jenis_barang'         => 'required|string|max:100',
                'jenis_kerusakan'      => 'required|string|max:255',
                'keterangan_tambahan'  => 'nullable|string',
                'foto_kerusakan'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            // Upload foto (jika ada)
            $fotoPath = null;
            if ($request->hasFile('foto_kerusakan')) {
                $fotoPath = $request->file('foto_kerusakan')->store('foto_perbaikan', 'public');
            }

            // Simpan data ke database
            PengajuanPerbaikan::create([
                'user_id'              => Auth::id(), // ambil dari user login
                'asset_id'             => $validated['asset_id'] ?? null,
                'kode_barang'          => $validated['kode_barang'],
                'nama_barang'          => $validated['nama_barang'],
                'jenis_barang'         => $validated['jenis_barang'],
                'jenis_kerusakan'      => $validated['jenis_kerusakan'],
                'keterangan_tambahan'  => $validated['keterangan_tambahan'] ?? null,
                'foto_kerusakan_path'  => $fotoPath,
                'tgl_pengajuan'        => now(), // otomatis tanggal hari ini
                'status'               => 'Menunggu Persetujuan', // status default
            ]);

            return redirect()->back()->with('success', 'Pengajuan perbaikan berhasil dikirim.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }
}
