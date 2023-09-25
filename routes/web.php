<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SampahController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('Guest');

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('Login');

Route::get('/dashboard', [DashboardController::class, 'index']);

Route::resource('/jenis', JenisController::class)->middleware(['Login', 'Admin']);
Route::resource('/sampah', SampahController::class)->middleware(['Login', 'Admin']);

Route::resource('/transaksi', TransaksiController::class)->middleware('Login');
Route::get('/daftar-sampah', [TransaksiController::class, 'sampah'])->middleware('Login');
Route::get('/transaksi-sampah', [TransaksiController::class, 'riwayat'])->middleware(['Login', 'Admin']);