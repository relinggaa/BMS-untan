<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelaporanCatatan extends Model
{
    use HasFactory;

    protected $table = 'pelaporan_catatan';

    protected $fillable = [
        'laporan_id', 
        'catatan',   
    ];


    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'laporan_id');
    }
}