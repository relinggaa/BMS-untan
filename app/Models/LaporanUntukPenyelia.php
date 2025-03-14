<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanUntukPenyelia extends Model
{
    use HasFactory;
    protected $table = 'laporan_untuk_penyelia'; 
    protected $fillable = [
        'file_path',
        'laporan_id',
    ];


    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'laporan_id');
    }
}