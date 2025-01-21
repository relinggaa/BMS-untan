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

Route::get('/login-penyelia', function () {
    return view('login-penyelia'); 
})->name('login.penyelia');
Route::post('/logout', [KeyController::class, 'logout'])->name('logout');
Route::get('/keys', [KeyController::class, 'index'])->name('keys.index');
Route::delete('/keys/{id}', [KeyController::class, 'destroy'])->name('keys.destroy');