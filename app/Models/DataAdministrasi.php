<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class DataAdministrasi extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    // Tentukan nama tabel jika berbeda dengan nama model
    protected $table = 'data_administrasi';  // Sesuaikan dengan nama tabel yang benar

    protected $fillable = ['name', 'file_path']; // Kolom yang dapat diisi
}