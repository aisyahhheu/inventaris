<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('form_perbaikan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_pengajuan');
            $table->string('nama_barang', 255);
            $table->string('kode_barang', 50);
            $table->string('jenis_barang', 100);
            $table->string('jenis_kerusakan', 255);
            $table->text('keterangan_tambahan');
            $table->string('foto_kerusakan', 255)->nullable(); // nullable() berarti tidak wajib diisi
            $table->string('status', 50)->default('Disetujui');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form_perbaikan');
    }
};
