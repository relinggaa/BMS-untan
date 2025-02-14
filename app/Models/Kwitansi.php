<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kwitansi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor',
        'terima_dari',
        'supplier',
        'proyek',
        'total_tagihan',
        'pembayaran_dp',
        'sisa_pembayaran',
        'untuk_pembayaran',
        'tanggal'
    ];
}