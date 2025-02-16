<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'no_invoice' => 'required|unique:invoices',
            'nama_perusahaan' => 'required',
            'nama_proyek' => 'required',
            'teknisi' => 'required|array',  // Ensure it's an array
            'jenis_material' => 'required',
            'jenis_pengujian' => 'required',
            'jumlah' => 'required|numeric',
            'jenis_pembayaran' => 'required',
            'bukti_pembayaran' => 'required|file',
        ]);
    
        // Use implode() to convert array to a comma-separated string without quotes
        $teknisiString = implode(',', $request->teknisi);
    
        $invoice = Invoice::create([
            'no_invoice' => $request->no_invoice,
            'nama_perusahaan' => $request->nama_perusahaan,
            'nama_proyek' => $request->nama_proyek,
            'permohonan' => $request->permohonan,
            'tanggal_datang' => $request->tanggal_datang,
            'teknisi' => $teknisiString,  
            'jenis_material' => $request->jenis_material,
            'jenis_pengujian' => $request->jenis_pengujian,
            'jumlah' => $request->jumlah,
            'jenis_pembayaran' => $request->jenis_pembayaran,
            'bukti_pembayaran' => $request->file('bukti_pembayaran')->store('bukti_pembayaran'),
        ]);
    
        return view('index-bendahara')->with('success', 'Invoice created successfully');
    }
    
}