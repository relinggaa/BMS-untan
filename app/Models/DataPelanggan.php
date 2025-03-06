<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPelanggan extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_invoice', 'nama_perusahaan', 'nama_proyek', 'permohonan', 'tanggal_datang', 'kegiatan',  'pembayaran','keterangan' 
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