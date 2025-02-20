<?php

use Illuminate\Http\Request;

use App\Exports\InvoicesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeyController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\BendaharaController;
use App\Http\Controllers\PengujianController;
use App\Http\Controllers\DataPelangganController;
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




Route::get('/login-teknisi', function () {
    return view('login-teknisi');
})->name('login.teknisi');

Route::post('/verify-teknisi', [KeyController::class, 'verifyTeknisi'])->name('verify.teknisi');

Route::get('/dashboard-teknisi', [KeyController::class, 'indexTeknisi'])->name('dashboard.teknisi');

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
Route::get('/dashboard-pelaporan', [KeyController::class, 'indexPelaporan'])->name('dashboard.pelaporan');
Route::get('/login-penyelia', function () {
    return view('login-penyelia');
})->name('login.penyelia');

Route::post('/verify-penyelia', [KeyController::class, 'verifyPenyelia'])->name('verify.penyelia');

Route::get('/dashboard-penyelia', [KeyController::class, 'indexPenyelia'])->name('dashboard.penyelia');


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


Route::post('/invoice', [InvoiceController::class, 'store'])->name('invoice.store');

Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoice.index');




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

// Route untuk update
Route::put('/data-pelanggan/{id}', [DataPelangganController::class, 'update'])->name('data.pelanggan.update');
Route::post('/data-pelanggan/{id}/send-to-bendahara', [DataPelangganController::class, 'sendToBendahara'])->name('data.pelanggan.sendToBendahara');
Route::post('/data-pelanggan/{id}/send-to-teknisi', [DataPelangganController::class, 'sendToTeknisi'])->name('data.pelanggan.sendToTeknisi');