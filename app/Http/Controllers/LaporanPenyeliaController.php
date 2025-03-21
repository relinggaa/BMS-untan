<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanUntukPenyelia;
use App\Models\PelaporanCatatan;

class LaporanPenyeliaController extends Controller
{
    public function indexPenyelia()
    {
        $laporanPenyelia = LaporanUntukPenyelia::with('laporan')->get();
        return view('index-penyelia', compact('laporanPenyelia'));
    }

    public function storeCatatan(Request $request, $laporan_id)
    {
        $request->validate([
            'catatan' => 'required|string',
        ]);

        PelaporanCatatan::create([
            'laporan_id' => $laporan_id,
            'catatan' => $request->catatan,
        ]);

        return redirect()->back()->with('success-buat-catatan', 'Catatan berhasil ditambahkan!');
    }
}
