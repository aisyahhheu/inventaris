<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanPerbaikan extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'pengajuan_perbaikan';

    // Kolom-kolom yang boleh diisi secara massal (mass assignable)
    protected $fillable = [
        'user_id',             // ID user (pegawai) yang mengajukan
        'asset_id',            // ID aset yang diajukan
        'kode_barang',         
        'nama_barang',         
        'jenis_kerusakan',     // Contoh: Patah, Mati Total
        'keterangan_tambahan', 
        'foto_kerusakan_path', // Lokasi file foto kerusakan
        'tgl_pengajuan',       // Tanggal pengajuan
        'status',              // Status persetujuan
    ];

    /**
     * Set tipe data untuk kolom tanggal_pengajuan sebagai date
     */
    protected $casts = [
        'tgl_pengajuan' => 'date',
    ];
    
    // Di sini Anda bisa menambahkan fungsi relasi seperti asset() atau user()
}
