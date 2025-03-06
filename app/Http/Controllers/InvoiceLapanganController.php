<?php

namespace App\Http\Controllers;

use App\Models\InvoiceLapangan;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class InvoiceLapanganController extends Controller
{
  
    public function create()
    {
        return view('invoice-lapangan.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'excel_lab' => 'required|mimes:xlsx,xls', 
            'excel_lab_dengan_harga' => 'required|mimes:xlsx,xls', 
            'teknisi' => 'required|array|min:1', 
        ]);
    
        try {
            // Mendapatkan file dan nama asli file
            $excelLab = $request->file('excel_lab');
            $excelLabDenganHarga = $request->file('excel_lab_dengan_harga');
            
            // Menyimpan file dengan nama asli
            $excelLabPath = $excelLab->storeAs('excel_files', $excelLab->getClientOriginalName(), 'public');
            $excelLabDenganHargaPath = $excelLabDenganHarga->storeAs('excel_files', $excelLabDenganHarga->getClientOriginalName(), 'public');
            
            Log::info('Excel Lab File Stored: ' . $excelLabPath);
            Log::info('Excel Lab Dengan Harga File Stored: ' . $excelLabDenganHargaPath);
    
            // Convert teknisi menjadi string
            $teknisiString = implode(',', $request->teknisi);
    
            // Menyimpan data invoice ke database
            $invoice = InvoiceLapangan::create([
                'excel_lab' => $excelLabPath,
                'excel_lab_dengan_harga' => $excelLabDenganHargaPath,
                'teknisi' => $teknisiString,
            ]);
    
            Log::info('Invoice Lapangan Created:', [$invoice]);
    
            return redirect()->route('dashboard.bendahara')->with('success-buat-invoice-lapangan', 'Invoice Lapangan created successfully');
        } catch (\Exception $e) {
            Log::error('Invoice Creation Failed:', [$e->getMessage()]);
    
            return back()->with('error', 'Failed to create invoice lapangan, please try again!');
        }
    }
    


    public function edit($invoiceLapanganId)
    {
      
        $invoiceLapangan = InvoiceLapangan::findOrFail($invoiceLapanganId);

        return view('invoice-lapangan-edit', compact('invoiceLapangan'));


    }

    public function update(Request $request, $invoiceLapanganId)
    {
        $validated = $request->validate([
            'excel_lab' => 'file|mimes:xls,xlsx|max:2048',
            'excel_lab_dengan_harga' => 'file|mimes:xls,xlsx|max:2048',
            'teknisi' => 'array',
        ]);
    
        // Temukan invoice lapangan berdasarkan ID
        $invoiceLapangan = InvoiceLapangan::findOrFail($invoiceLapanganId);
    
        // Jika file excel_lab di-upload, simpan dengan nama asli
        if ($request->has('excel_lab')) {
            $excelLab = $request->file('excel_lab');
            $excelLabName = $excelLab->getClientOriginalName(); // Dapatkan nama asli file
            $excelLab->storeAs('excel_lapangan', $excelLabName, 'public'); // Simpan dengan nama asli
            $invoiceLapangan->excel_lab = 'excel_lapangan/' . $excelLabName;
        }
    

        if ($request->has('excel_lab_dengan_harga')) {
            $excelLabDenganHarga = $request->file('excel_lab_dengan_harga');
            $excelLabDenganHargaName = $excelLabDenganHarga->getClientOriginalName(); // Dapatkan nama asli file
            $excelLabDenganHarga->storeAs('excel_lapangan', $excelLabDenganHargaName, 'public'); // Simpan dengan nama asli
            $invoiceLapangan->excel_lab_dengan_harga = 'excel_lapangan/' . $excelLabDenganHargaName;
        }
    
 
        $invoiceLapangan->teknisi = implode(',', $request->teknisi);

        $invoiceLapangan->save();
    
     
        return redirect()->route('dashboard.bendahara')->with('success-edit-lapangan', 'Invoice Lapangan berhasil diperbarui');
    }
    

    // Menghapus Data Invoice Lapangan
    public function destroy($invoiceLapanganId)
    {
        // Menemukan Invoice Lapangan berdasarkan ID
        $invoiceLapangan = InvoiceLapangan::findOrFail($invoiceLapanganId);

        try {
            // Hapus file terkait dari penyimpanan
            if (Storage::disk('public')->exists($invoiceLapangan->excel_lab)) {
                Storage::disk('public')->delete($invoiceLapangan->excel_lab);
            }
            if (Storage::disk('public')->exists($invoiceLapangan->excel_lab_dengan_harga)) {
                Storage::disk('public')->delete($invoiceLapangan->excel_lab_dengan_harga);
            }

            // Hapus data invoice lapangan dari database
            $invoiceLapangan->delete();

            return redirect()->route('dashboard.bendahara')->with('success-hapus-invoice-lapangan', 'Invoice Lapangan berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus Invoice Lapangan!');
        }
    }
}