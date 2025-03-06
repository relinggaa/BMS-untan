<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceLapangan extends Model
{
    use HasFactory;

  
    protected $table = 'invoice_lapangan';


    protected $fillable = [
        'excel_lab',
        'excel_lab_dengan_harga',
        'teknisi',
    ];
}