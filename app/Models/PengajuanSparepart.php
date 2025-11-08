<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSparepart extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_sparepart';

    protected $fillable = [
        'nama_sparepart',
        'kode_barang',
        'jumlah',
        'alasan_pengajuan',
        'tanggal_pengajuan',
        'foto_kerusakan',
        'nama_pegawai',
        'status',
    ];
}
