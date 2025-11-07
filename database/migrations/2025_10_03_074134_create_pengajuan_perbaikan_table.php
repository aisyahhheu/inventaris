<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration untuk membuat tabel pengajuan_perbaikan.
     */
    public function up(): void
    {
        Schema::create('pengajuan_perbaikan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // relasi ke tabel users
            $table->unsignedBigInteger('asset_id')->nullable(); // relasi opsional ke tabel asset
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->string('jenis_barang')->nullable();
            $table->string('jenis_kerusakan');
            $table->text('keterangan_tambahan')->nullable();
            $table->string('foto_kerusakan_path')->nullable(); // path foto
            $table->date('tgl_pengajuan');
            $table->string('status')->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Undo migration (hapus tabel jika di-rollback).
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_perbaikan');
    }
};

