<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeyController;




Route::get('/', function () {
    return view('pilih-login'); 
})->name('pilih.login');

Route::get('/login-kepala', function () {
    return view('login-kepala'); 
})->name('login.kepala');


Route::post('/verify-kepala', [KeyController::class, 'verifyKepala'])->name('verify.kepala');


Route::get('/index-kepala', [KeyController::class, 'indexKepala'])->name('index.kepala');

Route::post('/generate-key', [KeyController::class, 'store'])->name('generate.key');

Route::post('/logout', [KeyController::class, 'logout'])->name('logout');


Route::get('/login-admin', function () {
    return view('login-admin'); 
})->name('login.admin');


Route::get('/login-bendahara', function () {
    return view('login-bendahara'); 
})->name('login.bendahara');


Route::get('/login-teknisi', function () {
    return view('login-teknisi'); 
})->name('login.teknisi');


Route::get('/login-pelaporan', function () {
    return view('login-pelaporan'); 
})->name('login.pelaporan');
<<<<<<< Updated upstream
=======
Route::post('/verify-pelaporan', [KeyController::class, 'verifyPelaporan'])->name('verify.pelaporan');
Route::get('/dashboard-pelaporan', [DataPelangganController::class, 'indexPelaporan'])->name('dashboard.pelaporan');
Route::get('/login-penyelia', function () {
    return view('login-penyelia');
})->name('login.penyelia');


Route::get('/penyelia', [LaporanPenyeliaController::class, 'indexPenyelia'])->name('penyelia.index');
Route::post('/laporan/{laporan_id}/storeCatatan', [LaporanPenyeliaController::class, 'storeCatatan'])->name('laporan.storeCatatan');



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

Route::post('/invoice', [InvoiceController::class, 'store'])->name('invoice.store');

Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoice.index');


Route::get('/invoice-lab/{invoiceLabId}/edit', [InvoiceController::class, 'edit'])->name('invoice-lab.edit');

// This route will handle the update (POST method)
Route::post('/invoice-lab/{invoiceLabId}', [InvoiceController::class, 'update'])->name('invoice-lab.update');


Route::delete('/invoice/{id}', [InvoiceController::class, 'destroy'])->name('invoice-lab.destroy');



  // For handling the form submission (update)






// web.php
Route::get('/cetak-invoice/{id}', [InvoiceController::class, 'cetakInvoice'])->name('invoice.cetak');

>>>>>>> Stashed changes

Route::get('/login-penyelia', function () {
    return view('login-penyelia'); 
})->name('login.penyelia');
Route::post('/logout', [KeyController::class, 'logout'])->name('logout');
Route::get('/keys', [KeyController::class, 'index'])->name('keys.index');
Route::delete('/keys/{id}', [KeyController::class, 'destroy'])->name('keys.destroy');