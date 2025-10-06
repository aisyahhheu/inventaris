<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('form_peminjaman', function (Blueprint $table) {
            $table->string('status', 50)->default('Disetujui');
        });
    }

    public function down(): void
    {
        Schema::table('form_peminjaman', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
