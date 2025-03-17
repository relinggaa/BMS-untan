<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsAcceptedToKwitansiAccTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('kwitansi_acc', function (Blueprint $table) {
            $table->boolean('is_accepted')->default(false); // Kolom untuk status diterima (default false)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kwitansi_acc', function (Blueprint $table) {
            $table->dropColumn('is_accepted');
        });
    }
}