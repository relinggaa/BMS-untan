<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanUntukPenyeliaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_untuk_penyelia', function (Blueprint $table) {
            $table->id();  
            $table->string('file_path');  
            $table->unsignedBigInteger('laporan_id');  // Foreign key column
            $table->timestamps(); 

 
            $table->foreign('laporan_id')->references('id')->on('laporans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop foreign key constraint and table
        Schema::table('laporan_untuk_penyelia', function (Blueprint $table) {
            $table->dropForeign(['laporan_id']);  // Drop foreign key before table deletion
        });

        Schema::dropIfExists('laporan_untuk_penyelia');
    }
}