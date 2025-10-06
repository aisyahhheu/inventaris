<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangKeluar; 

class BarangKeluarController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input pencarian dari query string (?search=...)
        $search = $request->input('search');

        // Kalau ada kata kunci → filter, kalau tidak ada → tampilkan semua
        $barangk = BarangKeluar::when($search, function ($query, $search) {
            return $query->where('kode_barang', 'like', "%{$search}%")
                         ->orWhere('nama_barang', 'like', "%{$search}%");
        })->get();

        return view('barangkeluar', [
            'barangk' => $barangk,
            'search'  => $search // biar bisa ditampilkan lagi di input search
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_barang'   => 'required|max:255',
            'tanggal_keluar'=> 'required|date',
            'nama_barang'   => 'required|max:255',
            'jumlah'        => 'required|integer|min:1',
            'jenis_barang'  => 'required|max:255',
            'satuan'        => 'required|max:50',
        ]);
        
        BarangKeluar::create($validatedData);

        return redirect()->route('barangkeluar')
                         ->with('success', 'Data barang keluar berhasil ditambahkan!');
    }

    public function export()
    {
        return back()->with('info', 'Fungsi export belum diimplementasikan.');
    }
}
