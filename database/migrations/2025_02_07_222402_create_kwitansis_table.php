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
        Schema::create('kwitansis', function (Blueprint $table) {
            $table->id();
            $table->string('nomor');
            $table->string('terima_dari');
            $table->string('supplier');
            $table->string('proyek');
            $table->decimal('total_tagihan', 15, 2);
            $table->decimal('pembayaran_dp', 15, 2);
            $table->decimal('sisa_pembayaran', 15, 2);
            $table->text('untuk_pembayaran');
            $table->date('tanggal');
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kwitansis');
    }
};