<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangMasuk; 

class BarangMasukController extends Controller
{
    // Tampilkan data barang masuk + fitur search
    public function index(Request $request)
    {
        // ambil query pencarian dari input form
        $search = $request->input('search');

        // kalau ada pencarian, filter data
        $barangs = BarangMasuk::when($search, function ($query, $search) {
            return $query->where('kode_barang', 'like', "%{$search}%")
                         ->orWhere('nama_barang', 'like', "%{$search}%");
        })->get();

        return view('barangmasuk', [
            'barangs' => $barangs,
            'search' => $search // biar input search tetap ada isinya
        ]);
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_barang' => 'required|max:255',
            'tanggal_masuk' => 'required|date',
            'nama_barang' => 'required|max:255',
            'jumlah' => 'required|integer|min:1',
            'jenis_barang' => 'required|max:255',
            'satuan' => 'required|max:50',
        ]);
        
        BarangMasuk::create($validatedData);

        return redirect()->route('barangmasuk')->with('success', 'Data barang masuk berhasil ditambahkan!');
    }

    // Export data
    public function export()
    {
        return back()->with('info', 'Fungsi export belum diimplementasikan.');
    }
}
