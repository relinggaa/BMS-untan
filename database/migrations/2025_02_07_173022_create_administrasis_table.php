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
        Schema::create('administrasis', function (Blueprint $table) {
            $table->id();
            $table->string('no_invoice');
            $table->string('nama_perusahaan');
            $table->string('nama_proyek');
            $table->string('permohonan');
            $table->date('tanggal_datang');
            $table->date('tanggal_pembayaran_va');
            $table->decimal('total_harga', 15, 2);
            $table->decimal('uang_muka', 15, 2);
            $table->decimal('sisa', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('administrasis');
    }
};