<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TarifController;
use App\Http\Controllers\Admin\PenggunaanController;
use App\Http\Controllers\Admin\TagihanController;
use App\Http\Controllers\Admin\PembayaranController;
use App\Http\Controllers\Admin\LaporanController;


Route::get('/', [AuthController::class, 'index']);
Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'verify']);

Route::group(['middleware' => 'auth'], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/dashboard', [DashboardController::class, 'index']);
});

Route::group(['middleware' => 'admin'], function () {
    Route::resource('tarif', TarifController::class);
    Route::resource('penggunaan', PenggunaanController::class);
    Route::get('/approval', [PembayaranController::class, 'list']);
    Route::get('/approval/tagihan/{id}', [PembayaranController::class, 'approve']);
    Route::get('/laporan', [LaporanController::class, 'index']);
});

Route::group(['middleware' => 'pelanggan'], function () {
    Route::get('/profil', [DashboardController::class, 'showProfile']);
    Route::post('/profil', [DashboardController::class, 'updateProfile']);
    Route::get('/tagihan', [TagihanController::class, 'index']);
    Route::get('/tagihan/bayar/{id}', [TagihanController::class, 'bayar']);
    Route::get('/pembayaran', [PembayaranController::class, 'index']);
    Route::post('/pembayaran/{id}', [PembayaranController::class, 'update']);
});