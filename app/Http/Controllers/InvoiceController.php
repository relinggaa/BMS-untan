<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use App\Models\Invoice;
use App\Models\Pengujian;
use Illuminate\Http\Request;
use App\Models\DataPelanggan;
use App\Exports\InvoicesExport;
use App\Models\DataAdministrasi;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceController extends Controller
{
    public function store(Request $request)
    {
  
     
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
            'total_biaya' => 'required|numeric',
        ]);
    
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
            'bukti_pembayaran' => $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public'), // Store file publicly
            'total_biaya' => $request->total_biaya,
        ]);
    
 
        Log::info('Invoice Created:', [$invoice]);
    
      
        return redirect()->route('dashboard.bendahara')->with('success-buat-invoice', 'Invoice created successfully');
    }
    public function filterInvoice(Request $request)
    {

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
       
        $invoices = Invoice::whereBetween('tanggal_datang', [$startDate, $endDate])
                            ->orderBy('tanggal_datang', 'desc')
                            ->get();
    
        
        $files = DataAdministrasi::orderBy('created_at', 'desc')->get();
    

        $pelanggan = DataPelanggan::orderBy('created_at', 'desc')->get();
        $kasData = Kas::whereBetween('tanggal', [$startDate, $endDate])->get();
        $pengujianData = Pengujian::all();
    
     
        return view('index-bendahara', compact('invoices', 'files', 'pelanggan', 'pengujianData','kasData'))
               ->with('filter-tanggal', 'filter-tanggal-invoice');
    }
        public function exportInvoice(Request $request)
        {
            $startDate = $request->start_date;
            $endDate = $request->end_date;

           
            return Excel::download(new InvoicesExport($startDate, $endDate), 'invoice_' . $startDate . '_to_' . $endDate . '.xlsx');
        }
        // InvoiceController.php
        public function cetakInvoice($id)
        {
            // Fetch the invoice by ID
            $invoice = Invoice::findOrFail($id);
            
            // Pass the invoice data to the cetak-invoice view
            return view('cetak-invoice', compact('invoice'));
        }

}