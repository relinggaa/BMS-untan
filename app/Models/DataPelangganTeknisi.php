<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPelangganTeknisi extends Model
{
    use HasFactory;

    protected $table = 'data_pelanggan_teknisis';

    protected $fillable = [
        'data_pelanggan_id', 'no_invoice', 'nama_perusahaan', 'nama_proyek', 
        'permohonan', 'tanggal_datang','kegiatan', 'pembayaran', 'keterangan', 'created_at', 'updated_at'
    ];
    public function sendToBendahara()
    {
        return $this->hasOne(DataPelangganBendahara::class);
    }

    public function sendToTeknisi()
        {
            return $this->hasOne(DataPelangganTeknisi::class);
        }
}