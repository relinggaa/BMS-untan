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
        Schema::table('laporan_untuk_penyelia', function (Blueprint $table) {
            $table->boolean('sent_to_penyelia')->default(false);  
        });
    }
    
    public function down()
    {
        Schema::table('laporan_untuk_penyelia', function (Blueprint $table) {
            $table->dropColumn('sent_to_penyelia');
        });
    }
    
};