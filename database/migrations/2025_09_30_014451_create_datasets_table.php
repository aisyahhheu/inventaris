<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_aset', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->unique(); 
            $table->string('nama_barang');
            $table->string('jenis_barang');
            $table->integer('jumlah'); 
            $table->string('satuan');
            $table->string('stok');
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_aset');
    }
};