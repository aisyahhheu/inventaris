<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSparepart;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class PembelianSparepartController extends Controller
{
    /**
     * Menampilkan semua pembelian sparepart (ADMIN)
     */
    public function index()
    {
        try {
            $dataPembelian = PengajuanSparepart::orderBy('id', 'desc')->get();
        } catch (\Exception $e) {
            $dataPembelian = [];
            Log::error("Gagal mengambil data Pembelian Sparepart: " . $e->getMessage());
        }

        return view('pembelian-sparepart', [
            'pembelian' => $dataPembelian,
        ]);
    }

    /**
     * Simpan pengajuan pembelian sparepart baru
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama_sparepart'    => 'required|string|max:255',
                'kode_barang'       => 'nullable|string|max:100',
                'jumlah'            => 'nullable|integer|min:1',
                'tanggal_pengajuan' => 'required|date',
                'alasan_pengajuan'  => 'nullable|string',
                'foto_kerusakan'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'nama_pegawai'      => 'required|string|max:255',
            ]);

            if ($request->hasFile('foto_kerusakan')) {
                $path = $request->file('foto_kerusakan')->store('kerusakan', 'public');
                $validated['foto_kerusakan'] = $path;
            }

            PengajuanSparepart::create([
                'nama_sparepart'    => $validated['nama_sparepart'],
                'kode_barang'       => $validated['kode_barang'],
                'jumlah'            => $validated['jumlah'] ?? 1,
                'alasan_pengajuan'  => $validated['alasan_pengajuan'],
                'tanggal_pengajuan' => $validated['tanggal_pengajuan'],
                'foto_kerusakan'    => $validated['foto_kerusakan'] ?? null,
                'nama_pegawai'      => $validated['nama_pegawai'],
                'status'            => 'Dipending',
            ]);

            return redirect()->back()->with('success', 'Pengajuan pembelian sparepart berhasil dikirim.');

        } catch (QueryException $e) {
            Log::error("Gagal menyimpan pengajuan sparepart: " . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }
}
