<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barang_keluar', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->unique(); 
            $table->date('tanggal_keluar');
            $table->string('nama_barang');
            $table->integer('jumlah');
            $table->string('jenis_barang'); 
            $table->string('satuan');
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang_keluar');
    }
};
