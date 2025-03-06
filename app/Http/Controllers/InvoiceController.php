<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\InvoiceImport; // If you plan to use Excel imports
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'excel_lab' => 'required|mimes:xlsx,xls', 
            'excel_lab_dengan_harga' => 'required|mimes:xlsx,xls', 
            'teknisi' => 'required|array|min:1', 
        ]);
    
        try {
            // Get the original file names
            $excelLabOriginalName = $request->file('excel_lab')->getClientOriginalName();
            $excelLabDenganHargaOriginalName = $request->file('excel_lab_dengan_harga')->getClientOriginalName();
            
            // Add timestamp to the original file names to ensure uniqueness
            $excelLabFileName = time() . '_' . $excelLabOriginalName;
            $excelLabDenganHargaFileName = time() . '_' . $excelLabDenganHargaOriginalName;
    
            // Store the uploaded files with their unique names
            $excelLabPath = $request->file('excel_lab')->storeAs('excel_files', $excelLabFileName, 'public');
            $excelLabDenganHargaPath = $request->file('excel_lab_dengan_harga')->storeAs('excel_files', $excelLabDenganHargaFileName, 'public');
          
            Log::info('Excel Lab File Stored: ' . $excelLabPath);
            Log::info('Excel Lab Dengan Harga File Stored: ' . $excelLabDenganHargaPath);
    
            // Combine teknisi array to string
            $teknisiString = implode(',', $request->teknisi);
    
            // Create new invoice
            $invoice = Invoice::create([
                'excel_lab' => $excelLabPath,
                'excel_lab_dengan_harga' => $excelLabDenganHargaPath,
                'teknisi' => $teknisiString,
            ]);
    
            Log::info('Invoice Created:', [$invoice]);
    
            return redirect()->route('dashboard.bendahara')->with('success-buat-invoice', 'Invoice created successfully');
        } catch (\Exception $e) {
            Log::error('Invoice Creation Failed:', [$e->getMessage()]);
            return back()->with('error', 'Failed to create invoice, please try again!');
        }
    }
    
    public function getInvoiceLabData($invoiceLabId)
    {
        $invoiceLab = Invoice::findOrFail($invoiceLabId);
        return response()->json($invoiceLab);
    }
    public function edit($invoiceLabId)
    {
        // Find the invoice lab by ID
        $invoiceLab = Invoice::findOrFail($invoiceLabId);
    
        // Return the view and pass the invoice lab details
        return view('invoices-edit', compact('invoiceLab'));
    }
    
    public function update(Request $request, $invoiceLabId)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'excel_lab' => 'file|mimes:xls,xlsx|max:2048', // Adjust the validation as needed
            'excel_lab_dengan_harga' => 'file|mimes:xls,xlsx|max:2048',
            'teknisi' => 'array',
        ]);
    
        // Find the invoice lab by ID
        $invoiceLab = Invoice::findOrFail($invoiceLabId);
    
        // Check if the excel_lab file is being uploaded
        if ($request->has('excel_lab')) {
            // Get the original file name
            $excelLabOriginalName = $request->file('excel_lab')->getClientOriginalName();
    
            // Add timestamp to the original file name
            $excelLabFileName = time() . '_' . $excelLabOriginalName;
    
            // Store the file with the new name
            $invoiceLab->excel_lab = $request->file('excel_lab')->storeAs('excel_lab', $excelLabFileName, 'public');
        }
    
        // Check if the excel_lab_dengan_harga file is being uploaded
        if ($request->has('excel_lab_dengan_harga')) {
            // Get the original file name
            $excelLabDenganHargaOriginalName = $request->file('excel_lab_dengan_harga')->getClientOriginalName();
    
            // Add timestamp to the original file name
            $excelLabDenganHargaFileName = time() . '_' . $excelLabDenganHargaOriginalName;
    
            // Store the file with the new name
            $invoiceLab->excel_lab_dengan_harga = $request->file('excel_lab_dengan_harga')->storeAs('excel_lab_dengan_harga', $excelLabDenganHargaFileName, 'public');
        }
    
        // Update the teknisi field (array to string)
        $invoiceLab->teknisi = implode(',', $request->teknisi);
    
        // Save the updated invoice
        $invoiceLab->save();
    
        // Redirect with success message
        return redirect()->route('dashboard.bendahara')->with('success-edit-invoicelab', 'Invoice Lab updated successfully');
    }
    public function destroy($invoiceLabId)
{
    // Find the invoice lab by ID
    $invoiceLab = Invoice::findOrFail($invoiceLabId);

    // Delete the associated files from storage
    if (Storage::disk('public')->exists($invoiceLab->excel_lab)) {
        Storage::disk('public')->delete($invoiceLab->excel_lab);
    }
    
    if (Storage::disk('public')->exists($invoiceLab->excel_lab_dengan_harga)) {
        Storage::disk('public')->delete($invoiceLab->excel_lab_dengan_harga);
    }

    // Delete the invoice from the database
    $invoiceLab->delete();

    // Redirect back with success message
    return redirect()->route('dashboard.bendahara')->with('success-hapus-invoicelab', 'Invoice Lab deleted successfully');
}
    

    

}