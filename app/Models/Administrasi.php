<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_invoice',
        'nama_perusahaan',
        'nama_proyek',
        'permohonan',
        'tanggal_datang',
        'tanggal_pembayaran_va',
        'total_harga',
        'uang_muka',
        'sisa',
    ];
}