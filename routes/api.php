<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\KabupatenApiController;
use App\Http\Controllers\Api\KecamatanApiController;

Route::get('/tes-api', function () {
    return response()->json(['message' => 'API OK']);
});

Route::get('/kabupaten', [KabupatenApiController::class, 'index']);
Route::post('/kabupaten', [KabupatenApiController::class, 'store']);

Route::get('/kecamatan', [KecamatanApiController::class, 'index']);
Route::post('/kecamatan', [KecamatanApiController::class, 'store']);
