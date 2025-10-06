<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dataaset; 

class DataAsetController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input pencarian dari query string (?search=...)
        $search = $request->input('search');

        // Kalau ada kata kunci → filter, kalau tidak ada → tampilkan semua
        $dataaset = Dataaset::when($search, function ($query, $search) {
            return $query->where('kode_barang', 'like', "%{$search}%")
                         ->orWhere('nama_barang', 'like', "%{$search}%")
                         ->orWhere('jenis_barang', 'like', "%{$search}%");
        })->get();

        return view('dataaset', [
            'dataaset' => $dataaset, // ✅ variabel sudah sesuai
            'search'   => $search
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_barang'   => 'required|max:255',
            'nama_barang'   => 'required|max:255',
            'jenis_barang'  => 'required|max:255',
            'jumlah'        => 'required|integer|min:1',
            'satuan'        => 'required|max:50',
            'stok'          => 'required|integer|min:0',
        ]);
        
        Dataaset::create($validatedData);

        return redirect()->route('dataaset')
                         ->with('success', 'Data Aset berhasil ditambahkan!');
    }

    public function export()
    {
        return back()->with('info', 'Fungsi export belum diimplementasikan.');
    }
}
