<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerbaikanPegawai extends Model
{
    use HasFactory;

    protected $table = 'form_perbaikan';

    protected $fillable = [
        'user_id',
        'tanggal_pengajuan',
        'jenis_kerusakan',
        'nama_barang',
        'keterangan_tambahan',
        'kode_barang',
        'jenis_barang',
        'foto_kerusakan',
        'status',
    ];

    protected $casts = [
        'tanggal_pengajuan' => 'date',
    ];
}
