<?php

namespace App\Http\Controllers;

use App\Models\DataPelanggan;
use Illuminate\Http\Request;

class DataPelangganController extends Controller
{
   

    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'no_invoice' => 'required',
            'nama_perusahaan' => 'required',
            'nama_proyek' => 'required',
            'permohonan' => 'required',
            'tanggal_datang' => 'required|date',
            'teknisi' => 'required',
        ]);

        // Menyimpan data pelanggan
        DataPelanggan::create([
            'no_invoice' => $request->no_invoice,
            'nama_perusahaan' => $request->nama_perusahaan,
            'nama_proyek' => $request->nama_proyek,
            'permohonan' => $request->permohonan,
            'tanggal_datang' => $request->tanggal_datang,
            'teknisi' => $request->teknisi,
        ]);

        return redirect()->back()->with('success-simpan-pelanggan', 'Behasil');
    }
    public function edit($id)
    {
        $pelanggan = DataPelanggan::findOrFail($id);
        return view('edit-pelanggan', compact('pelanggan'));
    }

  
    public function destroy($id)
    {
        $pelanggan = DataPelanggan::findOrFail($id);
        $pelanggan->delete();
        
        return redirect()->route('data.pelanggan.index')->with('success', 'Pelanggan berhasil dihapus');
    }

}