<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Laporan;
use Illuminate\Http\Request;
use App\Models\DataPelanggan;
use App\Models\InvoiceLapangan;
use App\Models\LembarPengujian;
use App\Models\DataPelangganTeknisi;
use App\Models\DataPelangganBendahara;
use App\Models\LembarPengujianPelaporan;

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
           'kegiatan' => 'required|string',
           'pembayaran' => 'required|string',
           'keterangan' => 'required|string',
           
        ]);

 
        DataPelanggan::create([
            'no_invoice' => $request->no_invoice,
            'nama_perusahaan' => $request->nama_perusahaan,
            'nama_proyek' => $request->nama_proyek,
            'permohonan' => $request->permohonan,
            'tanggal_datang' => $request->tanggal_datang,
            'kegiatan' => $request->kegiatan,
            'pembayaran' => $request->pembayaran,
            'keterangan' => $request->keterangan,
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
        'kegiatan' => 'required|string',
        'pembayaran' => 'required|string',
        'keterangan' => 'required|string',
    
    ]);


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
            'kegiatan' => $pelanggan->kegiatan,
            'pembayaran' => $pelanggan->pembayaran,
            'keterangan' => $pelanggan->keterangan,
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
            'kegiatan' => $pelanggan->kegiatan,
            'pembayaran' => $pelanggan->pembayaran,
            'keterangan' => $pelanggan->keterangan,

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
    public function indexTeknisi()
    {
       
        $dataPelanggan = DataPelangganTeknisi::orderBy('created_at', 'desc')->get();
        $pdfFiles = LembarPengujian::orderBy('created_at', 'desc')->get();
        $invoiceLabs = Invoice::orderBy('created_at', 'desc')->get();
        $invoiceLapangan = InvoiceLapangan::orderBy('created_at', 'desc')->get();
        return view('index-teknisi', compact('dataPelanggan', 'pdfFiles', 'invoiceLabs', 'invoiceLapangan'));
    }
    public function indexPelaporan()
    {
    
        $dataPelanggan = DataPelanggan::orderBy('created_at', 'desc')->get();
        $lembarPengujianPelaporan = LembarPengujianPelaporan::with('lembarPengujian')->orderBy('created_at', 'desc')->get();
        $invoices = Invoice::orderBy('created_at', 'desc')->get(); 
        $invoiceLapangan = InvoiceLapangan::orderBy('created_at', 'desc')->get();
        $laporanFiles = Laporan::orderBy('created_at', 'desc')->get(); 
        return view('index-pelaporan', compact('dataPelanggan', 'lembarPengujianPelaporan', 'invoices', 'invoiceLapangan','laporanFiles'));
    }
    public function searchInvoice($no_invoice)
{
    
    $invoice = DataPelanggan::where('no_invoice', $no_invoice)->first();

    if ($invoice) {
        
        return response()->json($invoice);
    } else {
        
        return response()->json(null);
    }
}
}