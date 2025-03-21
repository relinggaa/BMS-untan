<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kwitansi extends Model
{
    use HasFactory;
    protected $table = 'kwitansi';
    protected $fillable = [
        'nomor_invoice',
        'supplier',
        'proyek',
        'total_tagihan',
        'jenis_pembayaran',
        'untuk_pembayaran',
         'telah_diterima',
    ];
}