<?php

use App\Models\Invoice;

use Illuminate\Http\Request;
use App\Models\DataPelanggan;
use App\Exports\InvoicesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KasController;
use App\Http\Controllers\KeyController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KwitansiController;
use App\Http\Controllers\BendaharaController;
use App\Http\Controllers\DfInvoiceController;
use App\Http\Controllers\PengujianController;
use App\Http\Controllers\KwitansiAccController;
use App\Http\Controllers\DaftarInvoiceController;
use App\Http\Controllers\DataPelangganController;
use App\Http\Controllers\InvoiceLapanganController;
use App\Http\Controllers\LaporanPenyeliaController;
use App\Http\Controllers\LembarPengujianController;
use App\Http\Controllers\DataAdministrasiController;

Route::get('/', function () {
    return view('pilih-login'); 
})->name('pilih.login');

Route::get('/login-kepala', function () {
    return view('login-kepala'); 
})->name('login.kepala');




Route::post('/verify-kepala', [KeyController::class, 'verifyKepala'])->name('verify.kepala');

Route::get('/dashboard-kepala', [KeyController::class, 'index'])->name('dashboard.kepala');














Route::post('/generate-key', [KeyController::class, 'store'])->name('generate.key');

Route::post('/logout', [KeyController::class, 'logout'])->name('logout');


Route::get('/login-admin', function () {
    return view('login-admin');
})->name('login.admin');

Route::post('/verify-admin', [KeyController::class, 'verifyAdmin'])->name('verify.admin');

Route::get('/dashboard-admin', [KeyController::class, 'indexAdmin'])->name('dashboard.admin');



Route::get('/login-bendahara', function () {
    return view('login-bendahara'); 
})->name('login.bendahara');

Route::post('/verify-bendahara', [KeyController::class, 'verifyBendahara'])->name('verify.bendahara');


Route::get('/dashboard-bendahara', [KeyController::class, 'indexBendahara'])->name('dashboard.bendahara');

Route::get('kas/export', [KasController::class, 'export'])->name('kas.export');
Route::get('kas/filter', [InvoiceController::class, 'filterInvoice'])->name('kas.filter');
Route::post('/kwitansi/{id}/send', [KwitansiController::class, 'sendToKepalaLab'])->name('kwitansi.send');

Route::delete('/kwitansi/{id}', [KwitansiController::class, 'destroy'])->name('kwitansi.destroy');

Route::delete('/lembar-pengujian/{id}', [LembarPengujianController::class, 'destroy'])->name('lembarPengujian.destroy');


Route::post('/lembar-pengujian/{id}/kirim', [LembarPengujianController::class, 'kirim'])->name('lembarPengujian.kirim');



Route::get('/login-teknisi', function () {
    return view('login-teknisi');
})->name('login.teknisi');

Route::post('/verify-teknisi', [KeyController::class, 'verifyTeknisi'])->name('verify.teknisi');

Route::get('/dashboard-teknisi', [DataPelangganController::class, 'indexTeknisi'])->name('dashboard.teknisi');
Route::post('lembar-pengujian/upload', [LembarPengujianController::class, 'uploadPDF'])->name('lembar-pengujian.upload');
Route::get('/login-pencetak', function () {
    return view('login-pencetak'); 
})->name('login.pencetak');

Route::post('/verify-pencetak', [KeyController::class, 'verifyPencetak'])->name('verify.pencetak');



Route::get('/dashboard-pencetak', [KeyController::class, 'indexPencetak'])->name('dashboard.pencetak');
Route::get('/bendahara', [BendaharaController::class, 'index'])->name('bendahara.index');

Route::get('data-pelanggan/export', function () {
    $startDate = request('start_date');
    $endDate = request('end_date');

    return Excel::download(new InvoicesExport($startDate, $endDate), 'pelanggan.xlsx');
});
Route::get('/invoices/export', function () {
    $startDate = request('start_date');
    $endDate = request('end_date');
    
       
    return Excel::download(new InvoicesExport($startDate, $endDate), 'invoices.xlsx');
})->name('invoice.export');
Route::get('/invoice/filter', [InvoiceController::class, 'filterInvoice'])->name('invoice.filter');
Route::get('/login-pelaporan', function () {
    return view('login-pelaporan'); 
})->name('login.pelaporan');
Route::post('/verify-pelaporan', [KeyController::class, 'verifyPelaporan'])->name('verify.pelaporan');
Route::get('/dashboard-pelaporan', [DataPelangganController::class, 'indexPelaporan'])->name('dashboard.pelaporan');
Route::get('/login-penyelia', function () {
    return view('login-penyelia');
})->name('login.penyelia');



Route::post('/laporan/{id}/catatan', [LaporanPenyeliaController::class, 'storeCatatan'])->name('laporan.storeCatatan');



Route::post('/verify-penyelia', [KeyController::class, 'verifyPenyelia'])->name('verify.penyelia');

Route::get('/dashboard-penyelia', [LaporanPenyeliaController::class, 'indexPenyelia'])->name('dashboard.penyelia');
Route::post('/laporan/upload', [LaporanController::class, 'upload'])->name('laporan.upload');
Route::delete('/laporan/{id}', [LaporanController::class, 'delete'])->name('laporan.delete');
Route::post('/laporan/send-to-penyelia/{id}', [LaporanController::class, 'sendToPenyelia'])->name('laporan.sendToPenyelia');
Route::get('/pengujian/create', [PengujianController::class, 'create'])->name('pengujian.create');  
Route::post('/pengujian', [PengujianController::class, 'store'])->name('pengujian.store');  
Route::get('/pengujian/{id}/edit', [PengujianController::class, 'edit'])->name('pengujian.edit');

Route::put('/pengujian/{id}', [PengujianController::class, 'update'])->name('pengujian.update');

Route::delete('/pengujian/{id}', [PengujianController::class, 'destroy'])->name('pengujian.destroy'); 


Route::get('/dashboard-admin', [DataAdministrasiController::class, 'showForm'])->name('dashboard.admin');
Route::get('/data-pelanggan', [DataAdministrasiController::class, 'showForm'])->name('data.pelanggan.index');
Route::post('/data-pelanggan/store', [DataPelangganController::class, 'store'])->name('data.pelanggan.store');
Route::get('/data-pelanggan/filter', [DataAdministrasiController::class, 'filter'])->name('data.pelanggan.filter');
Route::post('/data-administrasi/upload', [DataAdministrasiController::class, 'upload'])->name('data.administrasi.upload');
Route::get('/data-administrasi/files', [DataAdministrasiController::class, 'getFiles'])->name('data.administrasi.files');
Route::get('/dashboard-bendahara', [DataAdministrasiController::class, 'indexBendahara'])->name('dashboard.bendahara');
Route::get('/data-pelanggan-bendahara/{no_invoice}', [DataPelangganController::class, 'findByInvoice'])->name('data.pelanggan.findByInvoice');

Route::get('/kas/{kasId}/edit', [KasController::class, 'edit'])->name('kas.edit');

Route::put('/kas/{kasId}', [KasController::class, 'update'])->name('kas.update');

Route::get('/kas/{kasId}', [KasController::class, 'show'])->name('kas.show');

Route::post('/invoicelab', [InvoiceController::class, 'store'])->name('invoice.sto');

Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoice.index');


Route::get('/invoice-lab/{invoiceLabId}/edit', [InvoiceController::class, 'edit'])->name('invoice-lab.edit');

// This route will handle the update (POST method)
Route::post('/invoice-lab/{invoiceLabId}', [InvoiceController::class, 'update'])->name('invoice-lab.update');


Route::delete('/invoice/{id}', [InvoiceController::class, 'destroy'])->name('invoice-lab.destroy');



  // For handling the form submission (update)






// web.php
Route::get('/cetak-invoice/{id}', [InvoiceController::class, 'cetakInvoice'])->name('invoice.cetak');


Route::get('/login-penyelia', function () {
    return view('login-penyelia'); 
})->name('login.penyelia');
Route::post('/logout', [KeyController::class, 'logout'])->name('logout');

Route::get('/keys', [KeyController::class, 'index'])->name('keys.index');
Route::delete('/keys/{id}', [KeyController::class, 'destroy'])->name('keys.destroy');
// Route untuk edit
Route::get('/data-pelanggan/{id}/edit', [DataPelangganController::class, 'edit'])->name('data.pelanggan.edit');
Route::delete('/data-pelanggan/{id}', [DataPelangganController::class, 'destroy'])->name('data.pelanggan.destroy');
Route::get('/data-kwitansi/{nomorInvoice}', [DfInvoiceController::class, 'searchKwitansi']);

// Route untuk update
Route::put('/data-pelanggan/{id}', [DataPelangganController::class, 'update'])->name('data.pelanggan.update');
Route::post('/data-pelanggan/{id}/send-to-bendahara', [DataPelangganController::class, 'sendToBendahara'])->name('data.pelanggan.sendToBendahara');
Route::post('/data-pelanggan/{id}/send-to-teknisi', [DataPelangganController::class, 'sendToTeknisi'])->name('data.pelanggan.sendToTeknisi');
Route::post('/input-kas', [KasController::class, 'store'])->name('kas.submit');
// Route untuk update Kwitansi
Route::get('/kwitansi/edit/{id}', [KwitansiController::class, 'edit'])->name('kwitansi.edit');
Route::put('/kwitansi/update/{id}', [KwitansiController::class, 'update'])->name('kwitansi.update');


Route::get('/kwitansi/{id}', [KwitansiController::class, 'show'])->name('kwitansi.show');

Route::get('/kwitansi/create', [KwitansiController::class, 'create'])->name('kwitansi.create');

Route::post('/kwitansi', [KwitansiController::class, 'store'])->name('kwitansi.store');

Route::get('/kwitansi/create', [KwitansiController::class, 'create'])->name('kwitansi.create');


Route::post('/kwitansi', [KwitansiController::class, 'store'])->name('kwitansi.store');
// Route untuk menampilkan form create Invoice Lapangan
Route::get('/invoice-lapangan/create', [InvoiceLapanganController::class, 'create'])->name('invoice-lapangan.create');

// Route untuk menyimpan Invoice Lapangan
Route::post('/invoice-lapangan', [InvoiceLapanganController::class, 'store'])->name('invoice-lapangan.store');

// Route untuk menampilkan form edit Invoice Lapangan
Route::get('/invoice-lapangan/{id}/edit', [InvoiceLapanganController::class, 'edit'])->name('invoice-lapangan.edit');

// Route untuk memperbarui Invoice Lapangan
Route::put('/invoice-lapangan/{id}', [InvoiceLapanganController::class, 'update'])->name('invoice-lapangan.update');

// Route untuk menghapus Invoice Lapangan
Route::delete('/invoice-lapangan/{id}', [InvoiceLapanganController::class, 'destroy'])->name('invoice-lapangan.destroy');
// routes/web.php
// In routes/web.php

Route::get('/data-pelanggan/{no_invoice}', [DataPelangganController::class, 'searchInvoice']);

Route::get('/invoice/create', [DfInvoiceController::class, 'create'])->name('invoice.create');
Route::post('/invoice', [DfInvoiceController::class, 'store'])->name('invoice.store');
Route::post('/accept-kwitansi/{id}', [KwitansiAccController::class, 'accept'])->name('kwitansi.accept');
Route::get('/kwitansi/{id}', [KwitansiController::class, 'showDetail'])->name('kwitansi.detail');