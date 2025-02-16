<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPelangganBendahara extends Model
{
    use HasFactory;

    protected $table = 'data_pelanggan_bendaharas';

    protected $fillable = [
        'data_pelanggan_id', 'no_invoice', 'nama_perusahaan', 'nama_proyek', 
        'permohonan', 'tanggal_datang', 'teknisi', 'created_at', 'updated_at'
    ];
}