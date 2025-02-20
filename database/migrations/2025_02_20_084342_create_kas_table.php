<?php

// database/migrations/xxxx_xx_xx_create_kas_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKasTable extends Migration
{
    public function up()
    {
        Schema::create('kas', function (Blueprint $table) {
            $table->id();
            $table->string('no_bukti'); 
            $table->date('tanggal'); 
            $table->string('nama_kegiatan'); 
            $table->string('nama_perusahaan'); 
            $table->decimal('debet', 15, 2); 
            $table->string('keterangan')->nullable(); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kas');
    }
}