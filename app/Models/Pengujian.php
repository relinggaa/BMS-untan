<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengujian extends Model
{
    use HasFactory;

    protected $table = 'pengujian';

    protected $fillable = [
        'jenis_material',
        'jenis_pengujian',
        'harga_satuan',
    ];
}