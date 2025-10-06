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
        Schema::create('form_peminjaman', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pegawai', 255);
            $table->string('tim_kerja', 255);
            $table->string('tujuan_peminjaman', 255);
            $table->string('barang_yang_ingin_dipinjam', 255);
            $table->integer('jumlah');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->string('status', 50)->default('Disetujui');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_peminjaman');
    }
};
