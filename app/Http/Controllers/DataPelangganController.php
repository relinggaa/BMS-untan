<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPelanggan;
use App\Models\DataPelangganTeknisi;
use App\Models\DataPelangganBendahara;

class DataPelangganController extends Controller
{
   

    public function store(Request $request)
    {
  
        $request->validate([
            'no_invoice' => 'required',
            'nama_perusahaan' => 'required',
            'nama_proyek' => 'required',
            'permohonan' => 'required',
            'tanggal_datang' => 'required|date',
           'teknisi' => 'required|array',
           'teknisi.*' => 'string',
        ]);

 
        DataPelanggan::create([
            'no_invoice' => $request->no_invoice,
            'nama_perusahaan' => $request->nama_perusahaan,
            'nama_proyek' => $request->nama_proyek,
            'permohonan' => $request->permohonan,
            'tanggal_datang' => $request->tanggal_datang,
            'teknisi' => implode(',', $request->teknisi), 
        ]);

        return redirect()->back()->with('success-simpan-pelanggan', 'Behasil');
    }
    public function edit($id)
    {
        $pelanggan = DataPelanggan::find($id);
    
        if (!$pelanggan) {
            return response()->json(['message' => 'Data not found'], 404);
        }
    
        return response()->json($pelanggan);
    }
    public function update(Request $request, $id)
{
    $pelanggan = DataPelanggan::findOrFail($id);


    $validatedData = $request->validate([
        'no_invoice' => 'required|string',
        'nama_perusahaan' => 'required|string',
        'nama_proyek' => 'required|string',
        'permohonan' => 'required|string',
        'tanggal_datang' => 'required|date',
        'teknisi' => 'required|array',
        'teknisi.*' => 'string',
        
    ]);
    $validatedData['teknisi'] = implode(',', $request->teknisi);

    $pelanggan->update($validatedData);

    return redirect()->route('data.pelanggan.index')->with('success-edit-pelanggan', 'Data berhasil diperbarui');
}

    public function destroy($id)
    {
        $pelanggan = DataPelanggan::findOrFail($id);
        $pelanggan->delete();
        
        return redirect()->route('data.pelanggan.index')->with('success-hapus-pelanggan', 'Pelanggan berhasil dihapus');
    }
    public function sendToBendahara($id)
    {
        $pelanggan = DataPelanggan::findOrFail($id);
    
    
        DataPelangganBendahara::create([
            'data_pelanggan_id' => $pelanggan->id,
            'no_invoice' => $pelanggan->no_invoice,
            'nama_perusahaan' => $pelanggan->nama_perusahaan,
            'nama_proyek' => $pelanggan->nama_proyek,
            'permohonan' => $pelanggan->permohonan,
            'tanggal_datang' => $pelanggan->tanggal_datang,
            'created_at' => $pelanggan->created_at,
            'updated_at' => $pelanggan->updated_at,
            'teknisi' => $pelanggan->teknisi,
        ]);
    
   
        $pelanggan->sent_to_bendahara = true;
        $pelanggan->save();
    
        return redirect()->route('data.pelanggan.index')->with('success-kirim-bendahara', 'Data berhasil dikirim ke Bendahara');
    }
    

    public function sendToTeknisi($id)
    {
        $pelanggan = DataPelanggan::findOrFail($id);
    
      
        DataPelangganTeknisi::create([
            'data_pelanggan_id' => $pelanggan->id,
            'no_invoice' => $pelanggan->no_invoice,
            'nama_perusahaan' => $pelanggan->nama_perusahaan,
            'nama_proyek' => $pelanggan->nama_proyek,
            'permohonan' => $pelanggan->permohonan,
            'tanggal_datang' => $pelanggan->tanggal_datang,
            'created_at' => $pelanggan->created_at,
            'updated_at' => $pelanggan->updated_at,
            'teknisi' => $pelanggan->teknisi,
        ]);
    
     
        $pelanggan->sent_to_teknisi = true;
        $pelanggan->save();
    
        return redirect()->route('data.pelanggan.index')->with('success-kirim-teknisi', 'Data berhasil dikirim ke Teknisi');
    }
    public function findByInvoice($no_invoice)
    {
    
        $data = DataPelangganBendahara::where('no_invoice', $no_invoice)->first();


        if ($data) {
            return response()->json($data);
        }

    
        return response()->json(null);
    }

    public function getInvoice($noInvoice)
    {
        $data = DataPelangganBendahara::where('no_invoice', $noInvoice)->first();
        if ($data) {
         
            $data->teknisi = explode(',', $data->teknisi); 
            return response()->json($data);
        }
        return response()->json(null);
    }
    
}