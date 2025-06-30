<?php 

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\BerandaController; 
use App\Http\Controllers\LoginController; 
use App\Http\Controllers\UserController; 
use App\Http\Controllers\WargaController;
use App\Http\Controllers\RegisterController;


Route::get('/', function () { 
return redirect()->route('backend.login'); 
}); 

Route::get('backend/beranda', [BerandaController::class, 'berandaBackend']) ->name('backend.beranda')->middleware('auth'); 
Route::get('backend/login', [LoginController::class, 'loginBackend']) ->name('backend.login'); 
Route::post('backend/login', [LoginController::class, 'authenticateBackend']) ->name('backend.login'); 
Route::post('backend/logout', [LoginController::class, 'logoutBackend']) ->name('backend.logout'); 

Route::resource('backend/user', UserController::class, ['as' => 'backend']) ->middleware('auth');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::resource('backend/warga', WargaController::class, ['as' => 'backend'])
    ->middleware('auth');
