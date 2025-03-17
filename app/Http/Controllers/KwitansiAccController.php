<?php

// app/Http/Controllers/KwitansiAccController.php

// app/Http/Controllers/KwitansiAccController.php

namespace App\Http\Controllers;

use App\Models\KwitansiKepalaLab;
use App\Models\KwitansiAcc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KwitansiAccController extends Controller
{
    public function accept($id)
    {
        // Ambil data Kwitansi berdasarkan ID dari KwitansiKepalaLab
        $kwitansi = KwitansiKepalaLab::find($id);

        if ($kwitansi) {
            // Simpan data ke dalam tabel KwitansiAcc dan set 'is_accepted' ke true
            KwitansiAcc::create([
                'nomor_invoice' => $kwitansi->nomor_invoice,
                'supplier' => $kwitansi->supplier,
                'proyek' => $kwitansi->proyek,
                'total_tagihan' => $kwitansi->total_tagihan,
                'jenis_pembayaran' => $kwitansi->jenis_pembayaran,
                'untuk_pembayaran' => $kwitansi->untuk_pembayaran,
                'is_accepted' => true,  // Tandai kwitansi ini diterima di KwitansiAcc
            ]);

            // Perbarui status 'is_accepted' menjadi true di tabel KwitansiKepalaLab
            $kwitansi->update(['is_accepted' => true]);

            // Tambahkan log untuk memastikan status diperbarui
            Log::info('Kwitansi diterima, status is_accepted diperbarui.', [
                'kwitansi_id' => $kwitansi->id,
                'is_accepted' => $kwitansi->is_accepted,
            ]);

            // Redirect kembali dengan pesan sukses
            return redirect()->route('dashboard.kepala')->with('success-acc-kwitansi', 'Kwitansi berhasil diterima dan dipindahkan ke KwitansiAcc');
        }

        // Jika Kwitansi tidak ditemukan
        return redirect()->route('dashboard.kepala')->with('error', 'Kwitansi tidak ditemukan');
    }
}