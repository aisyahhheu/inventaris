<?php

namespace App\Http\Controllers;

use App\Models\PerbaikanPegawai;
use App\Models\User; // Ditambahkan untuk memastikan Model User terdeteksi
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
     * Simpan pengajuan perbaikan yang baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi Data
        // Validasi ini HARUS lolos. Jika ada yang kosong, data tidak akan disimpan.
        $validatedData = $request->validate([
            'tanggal_pengajuan' => 'required|date',
            'jenis_kerusakan' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|max:255',
            'jenis_barang' => 'required|string|max:255',
            'keterangan_tambahan' => 'nullable|string',
            'foto_kerusakan' => 'nullable|image|max:2048', 
        ]);

        try {
            // 2. Proses Upload Foto (jika ada)
            $fotoPath = null;
            if ($request->hasFile('foto_kerusakan')) {
                // Simpan foto di folder 'public/kerusakan'
                $fotoPath = $request->file('foto_kerusakan')->store('kerusakan', 'public');
            }

            // 3. Persiapkan Data yang Akan Disimpan
            $dataToStore = $validatedData;

            // Tambahkan USER ID HANYA JIKA USER SUDAH LOGIN
            // Ini mencegah error jika kolom 'user_id' diset NOT NULL
            if (auth()->check()) {
                $dataToStore['user_id'] = auth()->id();
            } else {
                // Jika user tidak login dan 'user_id' di database NOT NULL,
                // proses ini akan GAGAL. Solusi terbaik adalah menghapus
                // 'user_id' dari $fillable Model Anda.
            }
            
            // Tambahkan data non-form
            $dataToStore['foto_kerusakan'] = $fotoPath;
            $dataToStore['status'] = 'Pending'; // Nilai default 
            
            // 4. Simpan ke Database
            PerbaikanPegawai::create($dataToStore);

            // 5. Berhasil dan Redirect
            return redirect()->route('dashboard.pegawai')->with('success', 'Pengajuan perbaikan berhasil disimpan.');

        } catch (\Exception $e) {
            // 6. Gagal dan Catat Error
            Log::error('Gagal menyimpan pengajuan perbaikan: ' . $e->getMessage());
            
            // Tampilkan error yang lebih jelas di form
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data. Pastikan semua kolom terisi. Error: ' . $e->getMessage());
        }
    }
}
