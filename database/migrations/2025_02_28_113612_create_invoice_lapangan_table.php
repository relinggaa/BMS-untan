<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceLapanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_lapangan', function (Blueprint $table) {
            $table->id(); // ID kolom (auto increment)
            $table->string('excel_lab'); // Kolom untuk file excel lab
            $table->string('excel_lab_dengan_harga'); // Kolom untuk file excel lab dengan harga
            $table->string('teknisi'); // Kolom untuk teknisi
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_lapangan');
    }
}