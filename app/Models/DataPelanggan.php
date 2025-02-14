<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPelanggan extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_invoice', 'nama_perusahaan', 'nama_proyek', 'permohonan', 'tanggal_datang', 'teknisi'
    ];
}