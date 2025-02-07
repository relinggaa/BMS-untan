<?php

namespace App\Http\Controllers;

use App\Models\Administrasi;
use Illuminate\Http\Request;

class AdministrasiController extends Controller
{
    public function store(Request $request)
    {
      
        $validated = $request->validate([
            'no_invoice' => 'required|string|max:255',
            'nama_perusahaan' => 'required|string|max:255',
            'nama_proyek' => 'required|string|max:255',
            'permohonan' => 'required|string|max:255',
            'tanggal_datang' => 'required|date',
            'tanggal_pembayaran_va' => 'required|date',
            'total_harga' => 'required|numeric|min:0',
            'uang_muka' => 'required|numeric|min:0',
            'sisa' => 'required|numeric|min:0',
        ]);

        Administrasi::create($validated);
        
        return redirect()->route('bendahara.index')->with('success_simpan_data_adminitrasi', 'Data Berhasil Ditambahkan');
    }
    public function getAll()
    {
        $data = Administrasi::orderBy('created_at', 'desc')->get();
        return response()->json($data);
        
    }
    public function edit($id)
    {
        $invoice = Administrasi::findOrFail($id);
        return response()->json($invoice);
    }
    
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'no_invoice' => 'required|string|max:255',
            'nama_perusahaan' => 'required|string|max:255',
            'nama_proyek' => 'required|string|max:255',
            'permohonan' => 'required|string|max:255',
            'tanggal_datang' => 'required|date',
            'tanggal_pembayaran_va' => 'required|date',
            'total_harga' => 'required|numeric|min:0',
            'uang_muka' => 'required|numeric|min:0',
            'sisa' => 'required|numeric|min:0',
        ]);
    
        $invoice = Administrasi::findOrFail($id);
        $invoice->update($validated);
    
        return redirect()->route('dashboard.bendahara')->with('success_edit_invoice', 'Invoice berhasil diperbarui!');
    }
    public function destroy($id)
        {
            $invoice = Administrasi::findOrFail($id);
            $invoice->delete();

            return redirect()->route('bendahara.index')->with('success_hapus_invoice', 'Invoice berhasil dihapus.');
        }

    

}