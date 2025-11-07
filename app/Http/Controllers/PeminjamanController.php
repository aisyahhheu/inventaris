<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\PeminjamanPegawai;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class PeminjamanController extends Controller
{
    /**
     * Menampilkan semua data peminjaman untuk admin
     */
    public function index()
    {
        $peminjaman = Peminjaman::orderBy('tgl_pinjam', 'desc')->get();
        return view('peminjaman', compact('peminjaman'));
    }

    /**
     * Menampilkan detail peminjaman (untuk modal / halaman detail)
     */
    public function detail($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        return view('detail', compact('peminjaman')); // 👈 diarahkan ke file detail.blade.php langsung
    }

    /**
     * Update status peminjaman oleh admin
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $peminjaman = Peminjaman::findOrFail($id);

            $request->validate([
                'status' => 'required|in:Disetujui,Ditolak,Dipending,Selesai',
            ]);

            $peminjaman->status = $request->status;
            $peminjaman->save();

            if ($request->ajax()) {
                return response()->json(['message' => 'Status berhasil diperbarui menjadi ' . $request->status]);
            }

            return redirect()->route('peminjaman.index')->with('success', 'Status peminjaman berhasil diubah menjadi ' . $request->status . '.');

        } catch (QueryException $e) {
            return back()->with('error', 'Terjadi kesalahan saat mengubah status: ' . $e->getMessage());
        }
    }

    /**
     * Transfer data dari form pegawai ke tabel admin
     */
    public function fromPegawaiToAdmin(PeminjamanPegawai $pegawaiForm)
    {
        try {
            Peminjaman::create([
                'kode_barang'   => 'AUTO-' . strtoupper(substr($pegawaiForm->barang_yang_ingin_dipinjam, 0, 3)) . rand(100, 999),
                'nama_barang'   => $pegawaiForm->barang_yang_ingin_dipinjam,
                'nama_pegawai'  => $pegawaiForm->nama_pegawai,
                'unit_divisi'   => $pegawaiForm->tim_kerja,
                'jumlah'        => $pegawaiForm->jumlah,
                'tgl_pinjam'    => $pegawaiForm->tanggal_pinjam,
                'tgl_kembali'   => $pegawaiForm->tanggal_kembali,
                'status'        => 'Dipending',
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Gagal mengirim data ke admin: ' . $e->getMessage()
            ]);
        }
    }
}
