<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman; // Gunakan namespace yang sudah diimpor
use Illuminate\Http\Request;
use Illuminate\Database\QueryException; // Jika ingin menangkap error DB secara spesifik

class PeminjamanController extends Controller
{
    public function index()
    {
        // Jika model Peminjaman sudah diimpor, gunakan namanya secara langsung
        $peminjaman = Peminjaman::orderBy('tgl_pinjam', 'desc')->get();
        
        // Pastikan nama view benar (misalnya: 'peminjaman.index')
        return view('peminjaman', compact('peminjaman')); 
    }

    public function detail($id)
    {
        // Gunakan Peminjaman::findOrFail() agar secara otomatis menangani kasus ID tidak ditemukan (404)
        $data = Peminjaman::findOrFail($id); 

        return view('peminjaman.detail_modal_content', compact('data')); 
    }

    public function updateStatus(Request $request, $id)
    {
        // Gunakan findOrFail agar langsung throw 404 jika ID tidak ditemukan
        $peminjaman = Peminjaman::findOrFail($id); 

        // Lakukan validasi input status
        $request->validate([
            'status' => 'required|in:Disetujui,Ditolak,Selesai', // Sesuaikan status yang boleh diupdate
        ]);

        $peminjaman->status = $request->status;
        $peminjaman->save();

        // Redirect kembali ke halaman sebelumnya atau halaman index
        return redirect()->route('peminjaman.index')->with('success', 'Status peminjaman berhasil diubah menjadi ' . $request->status . '.');
    }
}