<?php

// app/Http/Controllers/KasController.php

namespace App\Http\Controllers;

use App\Models\Kas;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KasExport;
class KasController extends Controller
{
    public function store(Request $request)
    {
     
        $request->validate([
            
            'no_bukti' => 'required|string',
            'tanggal' => 'required|date',
            'nama_kegiatan' => 'required|string',
            'nama_perusahaan' => 'required|string',
            'debet' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);

     
        Kas::create([
           
            'no_bukti' => $request->no_bukti,
            'tanggal' => $request->tanggal,
            'nama_kegiatan' => $request->nama_kegiatan,
            'nama_perusahaan' => $request->nama_perusahaan,
            'debet' => $request->debet,
            'keterangan' => $request->keterangan,
        ]);

     
        return redirect()->back()->with('success-simpan-kas', 'Data KAS berhasil disimpan!');
    }
    public function show($kasId)
    {
        $kas = Kas::findOrFail($kasId);
        return response()->json($kas);
    }
    
    public function update(Request $request, $kasId)
    {
        $kas = Kas::findOrFail($kasId);
    
      
        $kas->no_bukti = $request->no_bukti;
        $kas->tanggal = $request->tanggal;
        $kas->nama_kegiatan = $request->nama_kegiatan;
        $kas->nama_perusahaan = $request->nama_perusahaan;
        $kas->debet = $request->debet;
        $kas->keterangan = $request->keterangan;
    
        $kas->save();
    
        return redirect()->route('dashboard.bendahara')->with('success-edit-kas', 'Kas updated successfully!');
    }
    public function export(Request $request)
    {
        // Get the start and end dates from the request
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        // Filter data based on the dates
        $kasData = Kas::whereBetween('tanggal', [$startDate, $endDate])->get();

        // Export the data
        return Excel::download(new KasExport($kasData), 'kas_data.xlsx');
    }
    public function filter(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $kasData = Kas::whereBetween('tanggal', [$startDate, $endDate])->get();

     
        return view('kas.index', compact('kasData'));
    }
}