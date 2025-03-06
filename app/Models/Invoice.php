<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    // The fields that are fillable in the database
    protected $fillable = [
        'excel_lab',
        'excel_lab_dengan_harga',
        'teknisi',
        // Other fields you want to save
    ];
}