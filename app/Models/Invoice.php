<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_invoice', 'nama_perusahaan', 'nama_proyek', 'permohonan', 
        'tanggal_datang', 'teknisi', 'jenis_material', 'jenis_pengujian',
        'jumlah', 'jenis_pembayaran', 'bukti_pembayaran','total_biaya'
    ];

    protected $casts = [
        'teknisi' => 'array', 
    ];
    protected static function boot()
{
    parent::boot();

    static::creating(function ($invoice) {
        Log::info('Creating invoice with teknisi: ', [$invoice->teknisi]);
    });
}

}