<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_invoice', 'nama_perusahaan', 'nama_proyek', 'permohonan', 
        'tanggal_datang', 'teknisi', 'jenis_material', 'jenis_pengujian',
        'jumlah', 'jenis_pembayaran', 'bukti_pembayaran','total_biaya'
    ];

    protected $casts = [
        'teknisi' => 'array', // This will automatically handle the array-to-string conversion
    ];
}