<?php



namespace App\Http\Controllers;

use App\Models\Invoice; 
use App\Models\Kwitansi;
use Illuminate\Http\Request;
use App\Models\KwitansiKepalaLab;

class KwitansiController extends Controller
{
    public function store(Request $request)
    {
    
        $request->validate([
            'nomor_invoice_kwitansi' => 'required|exists:invoices,no_invoice',
            'supplier_kwitansi' => 'required|string|max:255',
            'proyek_kwitansi' => 'required|string|max:255',
            'total_tagihan_kwitansi' => 'required|numeric',
            'jenis_pembayaran_kwitansi' => 'required|string|max:255',
            'untuk_pembayaran_kwitansi' => 'required|string|max:500',
        ]);

        $kwitansi = new Kwitansi;
        $kwitansi->nomor_invoice = $request->nomor_invoice_kwitansi;
        $kwitansi->supplier = $request->supplier_kwitansi;
        $kwitansi->proyek = $request->proyek_kwitansi;
        $kwitansi->total_tagihan = $request->total_tagihan_kwitansi;
        $kwitansi->jenis_pembayaran = $request->jenis_pembayaran_kwitansi;
        $kwitansi->untuk_pembayaran = $request->untuk_pembayaran_kwitansi;

        $kwitansi->save();

        return redirect()->back()->with('success-simpan-kwitansi', 'Kwitansi berhasil disimpan');
    }
    public function getKwitansiData($nomorInvoice)
    {
        
        $invoice = Invoice::where('no_invoice', $nomorInvoice)->first();

        if ($invoice) {
            return response()->json([
                'nama_perusahaan' => $invoice->nama_perusahaan,
                'nama_proyek' => $invoice->nama_proyek,
                'total_biaya' => $invoice->total_biaya,
                'jenis_pembayaran' => $invoice->jenis_pembayaran,
           
            ]);
        }

   
        return response()->json(null, 404);
    }
    public function update(Request $request, $id)
    {
        $kwitansi = Kwitansi::findOrFail($id);

        $request->validate([
            'nomor_invoice_kwitansi' => 'required',
            'supplier_kwitansi' => 'required',
            'proyek_kwitansi' => 'required',
            'total_tagihan_kwitansi' => 'required|numeric',
            'jenis_pembayaran_kwitansi' => 'required',
            'untuk_pembayaran_kwitansi' => 'required',
        ]);
    
        $kwitansi->nomor_invoice = $request->nomor_invoice_kwitansi;
        $kwitansi->supplier = $request->supplier_kwitansi;
        $kwitansi->proyek = $request->proyek_kwitansi;
        $kwitansi->total_tagihan = $request->total_tagihan_kwitansi;
        $kwitansi->jenis_pembayaran = $request->jenis_pembayaran_kwitansi;
        $kwitansi->untuk_pembayaran = $request->untuk_pembayaran_kwitansi;
    
        $kwitansi->save();
    
        return redirect()->route('dashboard.bendahara')->with('success-edit-kwitansi', 'Kwitansi berhasil diperbarui!');
    }
    public function show($id)
{
    $kwitansi = Kwitansi::find($id);
    if ($kwitansi) {
        return response()->json($kwitansi); 
    }
    return response()->json(['error' => 'Kwitansi not found'], 404);
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


}