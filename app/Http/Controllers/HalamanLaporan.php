<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HalamanLaporan extends Controller
{
    public function index()
    {
        // Mengambil data dari setiap tabel untuk user yang sedang login
        $userId = auth()->id();
        $dataPerbaikan = DB::table('form_perbaikan')->where('user_id', $userId)->get();
        $dataPembelian = DB::table('form_pembelian_sparepart')->where('user_id', $userId)->get();
         // 🔹 Data Peminjaman: join ke tabel admin untuk ambil status terbaru
        $dataPeminjaman = DB::table('form_peminjaman as f')
            ->leftJoin('peminjaman as a', function ($join) {
                $join->on('f.nama_pegawai', '=', 'a.nama_pegawai')
                    ->on('f.barang_yang_ingin_dipinjam', '=', 'a.nama_barang')
                    ->on('f.tanggal_pinjam', '=', 'a.tgl_pinjam');
            })
            ->where('f.user_id', $userId)
            ->select(
                'f.*',
                'a.status as status_admin' // 🔥 status dari admin
            )
            ->get();


        return view('auth.halamanlaporan', compact('dataPerbaikan', 'dataPembelian', 'dataPeminjaman'));
    }
}





   
