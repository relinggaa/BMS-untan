<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPelanggan;
use App\Models\DataAdministrasi;
use Illuminate\Support\Facades\Storage;






class DataAdministrasiController extends Controller
{
    public function showForm()
    {
      
        $files = DataAdministrasi::orderBy('created_at', 'desc')->get();
        $pelanggan = DataPelanggan::orderBy('created_at', 'desc')->get();
    
     
        return view('index-admin', compact('files', 'pelanggan'));
    }
    

    public function upload(Request $request)
    {
   
        $request->validate([
            'file' => 'required|mimes:pdf|max:10240', 
        ]);

  
        $filePath = $request->file('file')->storeAs('data_administrasi', time() . '_' . $request->file('file')->getClientOriginalName(), 'public');

      
        DataAdministrasi::create([
            'file_path' => $filePath
        ]);

        return redirect()->back()->with('success-mengupload-file', 'File berhasil di-upload!');
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