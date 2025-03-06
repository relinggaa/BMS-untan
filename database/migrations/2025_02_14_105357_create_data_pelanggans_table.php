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
        Schema::create('data_pelanggans', function (Blueprint $table) {
            $table->id();
            $table->string('no_invoice');
            $table->string('nama_perusahaan');
            $table->string('nama_proyek');
            $table->string('permohonan');
            $table->date('tanggal_datang');
            $table->string('kegiatan'); 
            $table->string('pembayaran'); 
            $table->string('keterangan'); 
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('data_pelanggan');
    }
    
};