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
        Schema::create('kwitansi_acc', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_invoice');
            $table->string('supplier');
            $table->string('proyek');
            $table->decimal('total_tagihan', 15, 2);
            $table->string('jenis_pembayaran');
            $table->string('untuk_pembayaran');
            $table->text('telah_diterima'); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kwitansi_accs');
    }
};