<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// In database/migrations/xxxx_xx_xx_create_daftar_invoices_table.php

public function up()
{
    Schema::create('daftar_invoices', function (Blueprint $table) {
        $table->id();
        $table->string('no_invoice');
        $table->string('nama_perusahaan');
        $table->string('nama_proyek');
        $table->string('permohonan');
        $table->date('tanggal_datang');
        $table->date('tanggal_pembayaran_ke_va');
        $table->decimal('total_harga', 15, 2);
        $table->string('jenis_pembayaran');
        $table->string('bukti_pembayaran');
        $table->timestamps();
        
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_invoices');
    }
};