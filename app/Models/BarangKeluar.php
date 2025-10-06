<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;
    protected $table = 'barang_keluar'; 
    protected $fillable = [
        'kode_barang', 
        'tanggal_keluar',  
        'nama_barang', 
        'jumlah', 
        'jenis_barang', 
        'satuan'
    ];
}
