<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    // Jika tabel di database namanya berbeda (misalnya 'form_perbaikan'),
    // tuliskan secara eksplisit:
    protected $table = 'form_perbaikan';

    // Kolom yang bisa diisi
    protected $fillable = [
        'id', 
        'nama_barang', 
        'tanggal_perbaikan', 
        'status', 
        'keterangan'
    ];
}
