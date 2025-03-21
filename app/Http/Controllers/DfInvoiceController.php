<?php

namespace App\Http\Controllers;

use App\Models\DfInvoice;



use Illuminate\Support\Str;
use Illuminate\Http\Request;



class DfInvoiceController extends Controller
{
    public function create()
    {
        return view('invoice.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_invoice' => 'required|string|max:255',
            'nama_perusahaan' => 'required|string|max:255',
            'nama_proyek' => 'required|string|max:255',
            'permohonan' => 'required|string|max:255',
            'tanggal_datang' => 'required|date',
            'tanggal_pembayaran_ke_va' => 'required|date',
            'total_harga' => 'required|numeric',
            'jenis_pembayaran' => 'required|string|max:255',
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

 
  
    $file = $request->file('bukti_pembayaran');


    $filename = Str::random(32) . '.' . $file->getClientOriginalExtension();
    $filePath = $file->storeAs('bukti_pembayaran', $filename);




     


    

        DfInvoice::create([
            'no_invoice' => $request->no_invoice,
            'nama_perusahaan' => $request->nama_perusahaan,
            'nama_proyek' => $request->nama_proyek,
            'permohonan' => $request->permohonan,
            'tanggal_datang' => $request->tanggal_datang,
            'tanggal_pembayaran_ke_va' => $request->tanggal_pembayaran_ke_va,
            'total_harga' => $request->total_harga,
            'jenis_pembayaran' => $request->jenis_pembayaran,
            'bukti_pembayaran' => $filePath,
        ]);

        return redirect()->route('dashboard.bendahara')->with('success-simpan-daftar-invoices', 'Invoice berhasil ditambahkan');
    }
    public function searchKwitansi(Request $request, $nomorInvoice)
    {

        $invoice = DfInvoice::where('no_invoice', $nomorInvoice)->first();


        if ($invoice) {
            return response()->json([
                'nama_perusahaan' => $invoice->nama_perusahaan,
                'nama_proyek' => $invoice->nama_proyek,
                'total_biaya' => $invoice->total_harga,
                'jenis_pembayaran' => $invoice->jenis_pembayaran,
                'untuk_pembayaran' => $invoice->permohonan, 
            ]);
        }

 
        return response()->json(['message' => 'Nomor invoice tidak ditemukan'], 404);
    }
  
}