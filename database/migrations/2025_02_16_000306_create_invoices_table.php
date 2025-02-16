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
    Schema::create('invoices', function (Blueprint $table) {
        $table->id();
        $table->string('no_invoice');
        $table->string('nama_perusahaan');
        $table->string('nama_proyek');
        $table->string('permohonan');
        $table->date('tanggal_datang');
        $table->json('teknisi');
        $table->string('jenis_material');
        $table->string('jenis_pengujian');
        $table->integer('jumlah');
        $table->string('jenis_pembayaran');
        $table->string('bukti_pembayaran');
        $table->decimal('total_biaya', 10, 2)->nullable(); ; 
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('total_biaya');
        });
    
    }
};