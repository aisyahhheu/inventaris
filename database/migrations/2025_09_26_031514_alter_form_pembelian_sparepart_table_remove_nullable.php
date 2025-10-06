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
        Schema::table('form_pembelian_sparepart', function (Blueprint $table) {
            $table->text('alasan_pengajuan')->nullable(false)->change();
            $table->string('foto_kerusakan', 255)->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('form_pembelian_sparepart', function (Blueprint $table) {
            $table->text('alasan_pengajuan')->nullable()->change();
            $table->string('foto_kerusakan', 255)->nullable()->change();
        });
    }
};
