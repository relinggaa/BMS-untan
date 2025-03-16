<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_path',  
        'laporan_id',
       
    ];
    public function laporanPenyelia()
    {
        return $this->hasMany(LaporanPenyelia::class);
    }
    public function catatan()
    {
        return $this->hasMany(PelaporanCatatan::class, 'laporan_id');
    }
}