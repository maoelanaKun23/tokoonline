<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\KurbanController;
use App\Http\Controllers\DistribusiQurbanController;
use App\Http\Controllers\DistribusiWargaController;



Route::get('/', function () {
    return redirect()->route('backend.login');
});

Route::get('backend/beranda', [BerandaController::class, 'berandaBackend'])->name('backend.beranda')->middleware('auth');
Route::get('backend/login', [LoginController::class, 'loginBackend'])->name('backend.login');
Route::post('backend/login', [LoginController::class, 'authenticateBackend'])->name('backend.login');
Route::post('backend/logout', [LoginController::class, 'logoutBackend'])->name('backend.logout');

Route::resource('backend/user', UserController::class, ['as' => 'backend'])->middleware('auth');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::resource('backend/warga', WargaController::class, ['as' => 'backend'])
    ->middleware('auth');

Route::resource('backend/lokasi', LokasiController::class, ['as' => 'backend'])
    ->middleware('auth');

// Route::resource('backend/kurban', KurbanController::class, ['as' => 'backend'])
//     ->middleware('auth');
// Route::resource('backend/distribusi_qurban', DistribusiQurbanController::class)->middleware('auth');
Route::middleware(['auth'])->prefix('backend')->name('backend.')->group(function () {
    Route::resource('kurban', KurbanController::class);

    Route::resource('distribusi_qurban', DistribusiQurbanController::class);

    Route::resource('distribusi_warga', DistribusiWargaController::class);
});
Route::middleware(['auth'])->prefix('backend')->name('backend.')->group(function () {
    Route::resource('panitia', \App\Http\Controllers\PanitiaController::class)
        ->except(['show'])
        ->parameters(['panitia' => 'panitia']);
});

