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
        Schema::create('form_pembelian_sparepart', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_pengajuan');
            $table->string('nama_sparepart', 255);
            $table->string('kode_barang_terkait', 255);
            $table->integer('jumlah');
            $table->text('alasan_pengajuan')->nullable();
            $table->string('foto_kerusakan', 255)->nullable();
            $table->string('status', 50)->default('Disetujui');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_pembelian_sparepart');
    }
};
