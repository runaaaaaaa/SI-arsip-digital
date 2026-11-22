<?php

use App\Http\Controllers\ArsipController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriArsipController;
use App\Http\Controllers\KodeKlasifikasiController;
use App\Http\Controllers\RakController;
use App\Http\Controllers\UserController;
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



Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('home');
    Route::get('login/{type}', [AuthController::class, 'loginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::put('/arsip/{id}/update-status', [ArsipController::class, 'updateStatus'])->name('arsip.updateStatus');
    Route::get('arsip/download/{id}', [ArsipController::class, 'download'])->name('arsip.download');
    Route::post('/arsip/search', [ArsipController::class, 'searchByKodeKlasifikasi'])->name('arsip.search');
    Route::resource('user', UserController::class);
    Route::resource('kode_klasifikasi', KodeKlasifikasiController::class);
    Route::resource('kategori_arsip', KategoriArsipController::class);
    Route::resource('rak', RakController::class);
    Route::resource('arsip', ArsipController::class);
});
