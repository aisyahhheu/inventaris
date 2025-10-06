<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dataaset extends Model
{
    use HasFactory;
    
    protected $table = 'data_aset'; 
    protected $fillable = [
        'kode_barang', 
        'nama_barang',  
        'jenis_barang',
        'jumlah', 
        'satuan',
        'stok'
    ];
}