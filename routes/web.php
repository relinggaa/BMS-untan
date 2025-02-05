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


Route::get('/login-penyelia', function () {
    return view('login-penyelia'); 
})->name('login.penyelia');
Route::post('/logout', [KeyController::class, 'logout'])->name('logout');
Route::get('/keys', [KeyController::class, 'index'])->name('keys.index');
Route::delete('/keys/{id}', [KeyController::class, 'destroy'])->name('keys.destroy');