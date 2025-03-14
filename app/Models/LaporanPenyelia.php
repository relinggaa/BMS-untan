<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPenyelia extends Model
{
    use HasFactory;
    protected $table = 'laporan_untuk_penyelia'; 
    protected $fillable = [
        'file_path',
        'laporan_id',
    ];
}