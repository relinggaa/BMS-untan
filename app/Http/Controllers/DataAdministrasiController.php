<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use App\Models\Invoice;
use App\Models\Kwitansi;
use App\Models\Pengujian;
use App\Models\KwitansiAcc;
use Illuminate\Http\Request;
use App\Models\DataPelanggan;
use App\Models\InvoiceLapangan;
use App\Models\DataAdministrasi;
use App\Models\DataPelangganBendahara;
use Illuminate\Support\Facades\Storage;






class DataAdministrasiController extends Controller
{
    public function showForm()
    {
      
        $files = DataAdministrasi::orderBy('created_at', 'desc')->get();
        $pelanggan = DataPelanggan::orderBy('created_at', 'desc')->get();
        $invoices = Invoice::orderBy('created_at', 'desc')->get();

   
        return view('index-admin', compact('files', 'pelanggan', 'invoices'));
    }
    public function indexBendahara()
    {
        
        $files = DataAdministrasi::orderBy('created_at', 'desc')->get();
        $pelanggan = DataPelanggan::orderBy('created_at', 'desc')->get();
        $pengujianData = Pengujian::all(); 
        $invoices = Invoice::orderBy('created_at', 'desc')->get();
        $kasData = Kas::orderBy('created_at', 'desc')->get();
        $kwitansis = Kwitansi::orderBy('created_at', 'desc')->get();
        $dataPelanggan = DataPelangganBendahara::orderBy('created_at', 'desc')->get();
        $invoicesLapangan = InvoiceLapangan::orderBy('created_at', 'desc')->get();
        $kwitansi_acc = KwitansiAcc::orderBy('created_at', 'desc')->get(); 
        return view('index-bendahara', compact('files', 'pelanggan', 'pengujianData','invoices','kasData','kwitansis','dataPelanggan','invoicesLapangan','kwitansi_acc'));
    }
    
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:10240', 
        ]);
    
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('data_administrasi', $filename, 'public');
    
            DataAdministrasi::create([
                'name' => pathinfo($filename, PATHINFO_FILENAME), 
                'file_path' => $filePath,
            ]);
    
            return back()->with('success-mengupload-file', 'File berhasil diunggah.');
        }
    
        return back()->with('error', 'Gagal mengunggah file.');
    }
    
    public function filter(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        

        $files = DataAdministrasi::orderBy('created_at', 'desc')->get();
        $pelanggan = DataPelanggan::whereBetween('tanggal_datang', [$start_date, $end_date])
                                ->orderBy('tanggal_datang', 'desc')
                                ->get();
                                
    
        return view('index-admin', compact('pelanggan', 'files'))
               ->with('filter-tanggal', value: 'Filter tanggal');
    }
    
}