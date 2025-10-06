<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianSparepartPegawai extends Model
{
    use HasFactory;

    protected $table = 'form_pembelian_sparepart';

    protected $fillable = [
        'user_id',
        'tanggal_pengajuan',
        'nama_sparepart',
        'kode_barang_terkait',
        'jumlah',
        'alasan_pengajuan',
        'foto_kerusakan',
        'status',
    ];

    protected $casts = [
        'tanggal_pengajuan' => 'date',
    ];
}
