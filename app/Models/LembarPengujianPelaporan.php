<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LembarPengujianPelaporan extends Model
{
    use HasFactory;

    protected $table = 'lembar_pengujian_pelapors';  

    protected $fillable = [
        'file_path',
        'lembar_pengujian_id',  
    ];


    public function lembarPengujian()
    {
        return $this->belongsTo(LembarPengujian::class, 'lembar_pengujian_id');
    }
}