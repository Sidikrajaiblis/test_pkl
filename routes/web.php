<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\wilayahController;
use App\Http\Controllers\LogikaController;


Route::get('/', function () {
    return view('welcome');
});

Route::resource('/kabupaten', KabupatenController::class);
Route::get('/kabupaten-cetak', [KabupatenController::class, 'cetak'])->name('kabupaten.cetak');

Route::resource('/kecamatan', KecamatanController::class);
Route::get('/kecamatan-cetak', [kecamatanController::class, 'cetak'])->name('kecamatan.cetak');

Route::get('/wilayah', [wilayahController::class, 'index'])->name('wilayah.index');
// Route::post('/wilayah/kabupaten', [wilayahController::class, 'storeKabupaten'])->name('kabupaten.store');
// Route::post('/wilayah/kecamatan', [wilayahController::class, 'storeKecamatan'])->name('kecamatan.store');

Route::get('/logika', [LogikaController::class, 'index'])->name('logika.index');
Route::post('/logika', [LogikaController::class, 'proses'])->name('logika.proses');
