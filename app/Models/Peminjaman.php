<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'peminjaman';

    // Kolom yang bisa diisi
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'nama_pegawai',
        'unit_divisi',
        'jumlah',
        'tgl_pinjam',
        'tgl_kembali',
        'status',
    ];
}