<?php

namespace App\Http\Controllers;

use App\Models\Laporan; 
use Illuminate\Http\Request;
use App\Models\LaporanPenyelia;
use App\Models\LaporanUntukPenyelia;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function upload(Request $request)
    {
     
        $validated = $request->validate([
            'file_pdf' => 'required|file|mimes:pdf|max:10240',  
        ]);
    
        if ($request->hasFile('file_pdf')) {
            $file = $request->file('file_pdf');
    

            $fileName = now()->format('Y-m-d_H-i-s') . '_' . $file->getClientOriginalName();
    

            $path = $file->storeAs('laporan_files', $fileName, 'public'); 
    

            Laporan::create([
                'file_path' => $path,
            ]);
        }
    
        return redirect()->route('dashboard.pelaporan')->with('success-upload-laporan', 'PDF uploaded successfully.');
    }


    public function delete($id)
    {
        $laporan = Laporan::findOrFail($id);
        
     
        if (Storage::disk('public')->exists($laporan->file_path)) {
            Storage::disk('public')->delete($laporan->file_path);
        }

    
        $laporan->delete();

        return redirect()->route('dashboard.pelaporan')->with('success-delete-laporan', 'File deleted successfully.');
    }
    public function sendToPenyelia($id)
    {
        $laporan = Laporan::findOrFail($id);
       
        $path = $laporan->file_path; 
        

        LaporanUntukPenyelia::create([
            'file_path' => $path,
            'laporan_id' => $laporan->id,
        ]);
        
     
        $laporan->sent_to_penyelia = true;
        $laporan->save();
        
        return redirect()->route('dashboard.pelaporan')->with('success-kirim-laporan', 'Laporan sent to penyelia.');
    }
    
    
    
    
}