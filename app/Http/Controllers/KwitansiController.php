<?php



namespace App\Http\Controllers;

use App\Models\Invoice; 
use App\Models\Kwitansi;
use App\Models\KwitansiAcc;
use Illuminate\Http\Request;
use App\Models\KwitansiKepalaLab;
use App\Models\DataPelangganBendahara;

class KwitansiController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validasi
            $request->validate([
                'nomor_invoice_kwitansi' => 'required|string|max:255',
                'supplier_kwitansi' => 'required|string|max:255',
                'proyek_kwitansi' => 'required|string|max:255',
                'total_tagihan_kwitansi' => 'required|numeric',
                'jenis_pembayaran_kwitansi' => 'required|string|max:255',
                'untuk_pembayaran_kwitansi' => 'required|string|max:500',
                'telah_diterima' => 'required|string|max:255',
            ]);
    
            // Simpan data ke database
            $kwitansi = new Kwitansi;
            $kwitansi->nomor_invoice = $request->nomor_invoice_kwitansi;
            $kwitansi->supplier = $request->supplier_kwitansi;
            $kwitansi->proyek = $request->proyek_kwitansi;
            $kwitansi->total_tagihan = $request->total_tagihan_kwitansi;
            $kwitansi->jenis_pembayaran = $request->jenis_pembayaran_kwitansi;
            $kwitansi->untuk_pembayaran = $request->untuk_pembayaran_kwitansi;
            $kwitansi->telah_diterima = $request->telah_diterima;
   
            $kwitansi->save();
    
            return redirect()->back()->with('success-simpan-kwitansi', 'Kwitansi berhasil disimpan');
        } catch (\Exception $e) {
        
            DD($e->getMessage());
        }
    }
    
    public function update(Request $request, $id)
    {
        $kwitansi = Kwitansi::find($id);
    
        if (!$kwitansi) {
            return redirect()->route('dashboard.bendahara')->with('error', 'Kwitansi not found');
        }
    
        $kwitansi->update([
            'nomor_invoice' => $request->nomor_invoice_kwitansi,
            'supplier' => $request->supplier_kwitansi,
            'proyek' => $request->proyek_kwitansi,
            'total_tagihan' => $request->total_tagihan_kwitansi,
            'jenis_pembayaran' => $request->jenis_pembayaran_kwitansi,
            'untuk_pembayaran' => $request->untuk_pembayaran_kwitansi,
            'telah_diterima' => $request->telah_diterima,
        ]);
    
        return redirect()->route('dashboard.bendahara')->with('success-edit-kwitansi', 'Kwitansi updated successfully');
    }
    
    public function show($id)
    {
        $kwitansi = Kwitansi::find($id);
    
        if ($kwitansi) {
            return response()->json($kwitansi);
        } else {
            return response()->json(['error' => 'Kwitansi not found'], 404);
        }
    }
    public function edit($id)
    {
        $kwitansi = Kwitansi::find($id);
        if ($kwitansi) {
            return view('kwitansi-edit', compact('kwitansi'));
        } else {
            return redirect()->route('kwitansi.index')->with('error', 'Kwitansi not found');
        }
    }
        
public function destroy($id)
{
    $kwitansi = Kwitansi::find($id);

    if ($kwitansi) {
        $kwitansi->delete();
        return redirect()->route('dashboard.bendahara')->with('success-hapus-kwintansi', 'Kwitansi berhasil dihapus');
    }

    return redirect()->route('dashboard.bendahara')->with('error', 'Kwitansi tidak ditemukan');
}
public function sendToKepalaLab($id)
{
    // Ambil data kwitansi yang akan dikirim
    $kwitansi = Kwitansi::find($id);

    if (!$kwitansi) {
        return redirect()->route('kwitansi.index')->with('error', 'Kwitansi tidak ditemukan');
    }

    $data = new KwitansiKepalaLab();
    $data->nomor_invoice = $kwitansi->nomor_invoice;
    $data->supplier = $kwitansi->supplier;
    $data->proyek = $kwitansi->proyek;
    $data->total_tagihan = $kwitansi->total_tagihan;
    $data->jenis_pembayaran = $kwitansi->jenis_pembayaran;
    $data->untuk_pembayaran = $kwitansi->untuk_pembayaran;
   
    
    $data->save();  

    $kwitansi->is_sent = true;
    $kwitansi->save();  

    return redirect()->route('dashboard.bendahara')->with('success-kirim-kepalalab', 'Kwitansi telah dikirim ke Kepala Lab');
}
public function getKwitansiData($nomorInvoice)
{
 
    $data = DataPelangganBendahara::where('no_invoice', $nomorInvoice)->first();

    if ($data) {
      
        return response()->json([
            'nama_perusahaan' => $data->nama_perusahaan,
            'nama_proyek' => $data->nama_proyek,
            'total_biaya' => $data->total_biaya, 
            'jenis_pembayaran' => $data->jenis_pembayaran,
            'untuk_pembayaran' => $data->untuk_pembayaran
        ]);
    } else {
      
        return response()->json(null);
    }
}
public function showDetail($id)
{
    $kwitansi = KwitansiAcc::findOrFail($id);
    return view('detail-kwitansi', compact('kwitansi'));
}

}