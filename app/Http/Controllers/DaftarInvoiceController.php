<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarInvoice;
use Illuminate\Support\Facades\Log;


class DaftarInvoiceController extends Controller
{
    public function store(Request $request)
    {
       
        $validatedData = $request->validate([
            'no_invoice' => 'required|unique:daftar_invoices',
            'nama_perusahaan' => 'required',
            'nama_proyek' => 'required',
            'permohonan' => 'required',
            'tanggal_datang' => 'required|date',
            'tanggal_pembayaran_ke_va' => 'required|date',
            'total_harga' => 'required|numeric',
            'jenis_pembayaran' => 'required',
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', 
        ]);

        $filePath = null; 
        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $filePath = $file->store('bukti_pembayaran', 'public');
          
        }
        


        DaftarInvoice::create([
            'no_invoice' => $validatedData['no_invoice'],
            'nama_perusahaan' => $validatedData['nama_perusahaan'],
            'nama_proyek' => $validatedData['nama_proyek'],
            'permohonan' => $validatedData['permohonan'],
            'tanggal_datang' => $validatedData['tanggal_datang'],
            'tanggal_pembayaran_ke_va' => $validatedData['tanggal_pembayaran_ke_va'],
            'total_harga' => $validatedData['total_harga'],
            'jenis_pembayaran' => $validatedData['jenis_pembayaran'],
            'bukti_pembayaran' => $filePath,
        ]);

        
        return redirect()->route('dashboard.bendahara')->with('success-simpan-daftar-invoices', 'Invoice successfully created!');
    }

    public function searchInvoice($noInvoice)
    {
        $invoice = DaftarInvoice::where('no_invoice', $noInvoice)->first();

        if ($invoice) {
            return response()->json([
                'nama_perusahaan' => $invoice->nama_perusahaan,
                'nama_proyek' => $invoice->nama_proyek,
                'permohonan' => $invoice->permohonan,
                'tanggal_datang' => $invoice->tanggal_datang,
                'tanggal_pembayaran_ke_va' => $invoice->tanggal_pembayaran_ke_va,
                'total_harga' => $invoice->total_harga,
                'jenis_pembayaran' => $invoice->jenis_pembayaran,
            ]);
        }

        return response()->json(null, 404); 
    }
}