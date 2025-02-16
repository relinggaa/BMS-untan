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
        Schema::table('data_pelanggans', function (Blueprint $table) {
            $table->boolean('sent_to_bendahara')->default(false);
            $table->boolean('sent_to_teknisi')->default(false);
        });
    }
    
    public function down()
    {
        Schema::table('data_pelanggans', function (Blueprint $table) {
            $table->dropColumn('sent_to_bendahara');
            $table->dropColumn('sent_to_teknisi');
        });
    }
    
};