<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LembarPengujianPelapor extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_path', 
        'data_pelanggan_bendahara_id', 
        'data_pelanggan_teknisi_id'
    ];

    public function pelangganBendahara()
    {
        return $this->belongsTo(DataPelangganBendahara::class);
    }

    public function pelangganTeknisi()
    {
        return $this->belongsTo(DataPelangganTeknisi::class);
    }
}