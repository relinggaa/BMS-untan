<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLembarPengujianPelaporsTable extends Migration
{
    public function up()
    {
        Schema::create('lembar_pengujian_pelapors', function (Blueprint $table) {
            $table->id();
            $table->string('file_path');
            $table->timestamps();
            $table->unsignedBigInteger('lembar_pengujian_id'); // Foreign Key
            $table->foreign('lembar_pengujian_id')->references('id')->on('lembar_pengujian')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('lembar_pengujian_pelapors');
    }
}