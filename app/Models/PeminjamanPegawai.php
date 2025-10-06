<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanPegawai extends Model
{
    use HasFactory;

    protected $table = 'form_peminjaman';

    protected $fillable = [
        'user_id',
        'nama_pegawai',
        'tim_kerja',
        'tujuan_peminjaman',
        'barang_yang_ingin_dipinjam',
        'jumlah',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
    ];
}
