<?php

namespace App\Http\Controllers;

use App\Models\Pengujian;
use Illuminate\Http\Request;

class PengujianController extends Controller
{
    // Menampilkan semua data pengujian


    // Menyimpan data pengujian baru
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'jenis_material' => 'required|string',
            'jenis_pengujian' => 'required|string',
            'harga_satuan' => 'required|numeric',
        ]);
    
        // Creating a new Pengujian record
        Pengujian::create([
            'jenis_material' => $request->jenis_material,
            'jenis_pengujian' => $request->jenis_pengujian,
            'harga_satuan' => $request->harga_satuan,
     
        ]);
    
        
        return redirect()->route('dashboard.kepala')->with('success-simpan-pengujian', 'Data Pengujian berhasil disimpan!');
    }
    
    public function edit($id)
    {
        $pengujian = Pengujian::findOrFail($id);
        
        return response()->json([
            'jenis_material' => $pengujian->jenis_material,
            'jenis_pengujian' => $pengujian->jenis_pengujian,
            'harga_satuan' => $pengujian->harga_satuan
        ]);
    }
    

    public function destroy($id)
    {
        $pengujian = Pengujian::findOrFail($id);
        $pengujian->delete();

        return redirect()->route('dashboard.kepala')->with('success-hapus-pengujian', 'Data Pengujian berhasil dihapus!');
    }
    public function update(Request $request, $id)
{
    $request->validate([
        'jenis_material' => 'required|string|max:255',
        'jenis_pengujian' => 'required|string|max:255',
        'harga_satuan' => 'required|numeric',
    ]);

    $pengujian = Pengujian::findOrFail($id);
    $pengujian->jenis_material = $request->jenis_material;
    $pengujian->jenis_pengujian = $request->jenis_pengujian;
    $pengujian->harga_satuan = $request->harga_satuan;
    $pengujian->save();

    return redirect()->route('dashboard.kepala')->with('success-edit-pengujian', 'Pengujian berhasil diperbarui!');
}
// Controller Method
public function createInvoiceForm()
{
 
    $pengujianData = Pengujian::all(); 

    return view('index-bendahara', compact('pengujianData'));
}


}