<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DfInvoice extends Model
{
    use HasFactory;

    protected $table = 'df_invoices';

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