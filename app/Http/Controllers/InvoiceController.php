<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrasi; 
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InvoicesExport; 

class InvoiceController extends Controller
{
    public function export(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
    
        $invoices = Administrasi::query();
    
        if ($startDate && $endDate) {
            $invoices = $invoices->whereBetween('tanggal_datang', [$startDate, $endDate]);
        }
    
        $invoices = $invoices->get();
    
        if ($invoices->isEmpty()) {
            return back()->with('error', 'Tidak ada data untuk diexport.');
        }
    
        return Excel::download(new InvoicesExport($invoices), 'invoices.xlsx');
    }
    
}