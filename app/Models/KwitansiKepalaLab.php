<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KwitansiKepalaLab extends Model
{
    use HasFactory;

    protected $table = 'kwitansiKepalaLab'; 
    protected $fillable = ['nomor_invoice', 'supplier', 'proyek', 'total_tagihan', 'jenis_pembayaran', 'untuk_pembayaran',  'is_accepted',];
}