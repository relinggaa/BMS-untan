<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InvoiceController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'no_invoice' => 'required|unique:invoices',
            'nama_perusahaan' => 'required',
            'nama_proyek' => 'required',
            'teknisi' => 'required|array',
            'jenis_material' => 'required',
            'jenis_pengujian' => 'required',
            'jumlah' => 'required|numeric',
            'jenis_pembayaran' => 'required',
            'bukti_pembayaran' => 'required|file',
            'total_biaya' => 'required|numeric', // Validate total biaya field
        ]);
    
        // Convert teknisi array to comma-separated string
        $teknisiString = implode(',', $request->teknisi);
    
        // Create the invoice record
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
            'bukti_pembayaran' => $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public'), // Store file publicly
            'total_biaya' => $request->total_biaya,
        ]);
    
 
        Log::info('Invoice Created:', [$invoice]);
    
      
        return redirect()->route('dashboard.bendahara')->with('success-buat-invoice', 'Invoice created successfully');
    }
    
}