<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\LembarPengujian;
use App\Models\LembarPengujianPelapor;
use Illuminate\Support\Facades\Storage;
use App\Models\LembarPengujianPelaporan;

class LembarPengujianController extends Controller
{
    public function uploadPDF(Request $request)
    {
        // Validate the uploaded file
        $validated = $request->validate([
            'file_pdf' => 'required|file|mimes:pdf|max:10240',  
        ]);
    
        // Handle the file upload
        if ($request->hasFile('file_pdf')) {
            $file = $request->file('file_pdf');
    
            // Generate a filename with the current datetime (format: YYYY-MM-DD_HH-MM-SS_originalname.pdf)
            $fileName = now()->format('Y-m-d_H-i-s') . '_' . $file->getClientOriginalName();
    
            // Store the file with the new filename
            $path = $file->storeAs('lembar_pengujian_files', $fileName, 'public'); 
    
            // Store the file path in the database
            LembarPengujian::create([
                'file_path' => $path,
            ]);
        }
    
        return redirect()->route('dashboard.teknisi')->with('success-simpan-pengujian', 'PDF uploaded successfully.');
    }
    public function destroy($id)
{
  
    $lembarPengujian = LembarPengujian::findOrFail($id);

   
    if (Storage::disk('public')->exists($lembarPengujian->file_path)) {
        Storage::disk('public')->delete($lembarPengujian->file_path);
    }

   
    $lembarPengujian->delete();


    return redirect()->route('dashboard.teknisi')->with('success-hapus-pengujian', 'PDF file deleted successfully.');
}



// Inside your controller method
public function kirim($id)
{
    $lembarPengujian = LembarPengujian::findOrFail($id);

    LembarPengujianPelaporan::create([
        'file_path' => $lembarPengujian->file_path, 
        'lembar_pengujian_id' => $lembarPengujian->id, 
    ]);

    $lembarPengujian->is_sent = true;
    $lembarPengujian->save();

    return redirect()->route('dashboard.teknisi')->with('success-kirim-pelaporan', 'Data sent to Pelaporan.');
}


}