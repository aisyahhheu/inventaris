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
        Schema::table('form_perbaikan', function (Blueprint $table) {
            $table->string('foto_kerusakan', 255)->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('form_perbaikan', function (Blueprint $table) {
            $table->string('foto_kerusakan', 255)->nullable()->change();
        });
    }
};
