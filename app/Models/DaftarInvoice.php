<?php


// app/Models/DaftarInvoice.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarInvoice extends Model
{
    use HasFactory;


    protected $table = 'daftar_invoices';

  
    protected $fillable = [
        'no_invoice',
        'nama_perusahaan',
        'nama_proyek',
        'permohonan',
        'tanggal_datang',
        'tanggal_pembayaran_ke_va',
        'total_harga',
        'jenis_pembayaran',
        'bukti_pembayaran', 
    ];


}