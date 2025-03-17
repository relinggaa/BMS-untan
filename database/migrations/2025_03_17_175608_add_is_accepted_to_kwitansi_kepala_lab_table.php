<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Menambahkan kolom 'is_accepted' ke tabel 'kwitansikepalalab'
        Schema::table('kwitansiKepalaLab', function (Blueprint $table) {
            $table->boolean('is_accepted')->default(false); // Kolom boolean dengan nilai default false
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kwitansiKepalaLab', function (Blueprint $table) {
            $table->dropColumn('is_accepted');
        });
    }
};