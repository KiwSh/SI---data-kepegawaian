<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportPegawaiController;
use App\Http\Controllers\DataPegawaiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\ProfilePerusahaanController;

Route::get('/profile', [ProfilePerusahaanController::class, 'index'])->name('profile.index');
Route::post('/profile', [ProfilePerusahaanController::class, 'store'])->name('profil.store');


Route::post('/pegawai/delete-all', [DataPegawaiController::class, 'deleteAll'])->name('pegawai.deleteAll');

Route::resource('jabatan', JabatanController::class);

Route::resource('pegawai', DataPegawaiController::class);


Route::post('/import-excel', [ImportPegawaiController::class, 'importExcel'])->name('import.excel');

// Rute untuk login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);

// Rute untuk logout (metode POST)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route Dashboard - Hanya untuk pengguna yang sudah login
Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');