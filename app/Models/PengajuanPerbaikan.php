<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PengajuanPerbaikan extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database
     */
    protected $table = 'pengajuan_perbaikan';

    /**
     * Kolom-kolom yang boleh diisi secara massal (mass assignable)
     */
    protected $fillable = [
        'user_id',              // ID user (pegawai)
        'asset_id',             // ID aset jika terkait aset tertentu
        'kode_barang',          // Kode unik barang
        'nama_barang',          // Nama barang
        'jenis_barang',         // Tambahan: jenis barang (elektronik, furniture, dll)
        'jenis_kerusakan',      // Contoh: Mati total, retak, patah
        'keterangan_tambahan',  // Keterangan tambahan
        'foto_kerusakan_path',  // Lokasi penyimpanan foto
        'tgl_pengajuan',        // Tanggal pengajuan
        'status',               // Status pengajuan
    ];

    /**
     * Ubah format data tanggal agar otomatis dikenali Laravel
     */
    protected $casts = [
        'tgl_pengajuan' => 'date',
    ];

    /**
     * Relasi ke model User (pegawai yang mengajukan)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke model Asset (jika ada)
     */
    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    /**
     * Akses URL publik dari foto kerusakan
     */
    public function getFotoKerusakanUrlAttribute()
    {
        return $this->foto_kerusakan_path 
            ? Storage::url($this->foto_kerusakan_path)
            : null;
    }
}
