<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnggotaController;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\LatihanController;

Route::get('/tabel', [LatihanController::class, 'getTabel']);
Route::get('/form', [LatihanController::class, 'getForm']);
Route::resource('anggota', AnggotaController::class);

