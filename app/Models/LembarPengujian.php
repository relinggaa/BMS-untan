<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LembarPengujian extends Model
{
    use HasFactory;

    protected $table = 'lembar_pengujian'; 
    
    protected $fillable = [
        'file_path',  
    ];

}