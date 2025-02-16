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
        Schema::create('data_pelanggan_teknisis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('data_pelanggan_id')->unique();
            $table->string('no_invoice');
            $table->string('nama_perusahaan');
            $table->string('nama_proyek');
            $table->string('permohonan');
            $table->date('tanggal_datang');
            $table->string('teknisi');
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pelanggan_teknisis');
    }
};