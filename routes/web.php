<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalonSiswaController;
use App\Http\Controllers\AdminController;

// Route untuk halaman depan
Route::get('/', [CalonSiswaController::class, 'index'])->name('home');

// Route untuk pendaftaran calon siswa
Route::get('/pendaftaran', [CalonSiswaController::class, 'create'])->name('pendaftaran.create');
Route::post('/pendaftaran', [CalonSiswaController::class, 'store'])->name('pendaftaran.store');
Route::get('/pendaftaran/sukses/{id}', [CalonSiswaController::class, 'success'])->name('pendaftaran.success');
Route::get('/pendaftaran/cetak/{id}', [CalonSiswaController::class, 'cetakBukti'])->name('pendaftaran.cetak');

// Route untuk cek status pendaftaran
Route::get('/cek-status', [CalonSiswaController::class, 'cekStatusForm'])->name('pendaftaran.cek-status-form');
Route::post('/cek-status', [CalonSiswaController::class, 'cekStatus'])->name('pendaftaran.cek-status');

// Route untuk admin
Route::prefix('admin')->name('admin.')->group(function () {
    // Route untuk login admin
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login']);
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    // Route yang memerlukan autentikasi admin
    Route::middleware(['admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Route untuk manajemen calon siswa
        Route::get('/calon-siswa', [AdminController::class, 'calonSiswaIndex'])->name('calon-siswa.index');
        Route::get('/calon-siswa/{id}', [AdminController::class, 'calonSiswaShow'])->name('calon-siswa.show');
        Route::put('/calon-siswa/{id}/status', [AdminController::class, 'updateStatus'])->name('calon-siswa.update-status');

        // Route untuk export data
        Route::get('/export/excel', [AdminController::class, 'exportExcel'])->name('export.excel');
        Route::get('/export/pdf', [AdminController::class, 'exportPDF'])->name('export.pdf');
    });
});
