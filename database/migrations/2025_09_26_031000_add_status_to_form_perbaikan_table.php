<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('form_perbaikan', function (Blueprint $table) {
            if (!Schema::hasColumn('form_perbaikan', 'status')) {
                $table->string('status')->default('Disetujui');
            }
        });
    }

    public function down(): void
    {
        Schema::table('form_perbaikan', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
