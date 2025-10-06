<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang', 10);
            $table->string('nama_barang', 50);
            $table->string('nama_pegawai', 50);
            $table->string('unit_divisi', 50);
            $table->integer('jumlah');
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali')->nullable(); // Bisa null jika belum ada tanggal pasti
            $table->enum('status', ['Disetujui', 'Ditolak', 'Dipending', 'Selesai'])->default('Dipending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};