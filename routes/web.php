<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaktaIntegritasController;
use App\Http\Controllers\LaporSpgController;
use App\Http\Controllers\StudiKelayakanController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\LaporController;

// Public Routes
Route::get('/', function () {
    return view('index');
});

Route::get('/studi-kelayakan', function () {
    return view('studi-kelayakan');
});

Route::get('/lapor', function () {
    return view('lapor');
});

Route::get('/spg', [LaporSpgController::class, 'publicIndex']);

Route::get('/web', function () {
    return view('web');
});

Route::get('/faq', function () {
    return view('faq');
});

route::get('/preview-email', [PaktaIntegritasController::class, 'previewEmail']);
Route::get('/laporan/preview/{id}', [LaporSpgController::class, 'previewPdf'])->name('laporan.preview');
Route::get('/download-studi-kelayakan/{id}', [StudiKelayakanController::class, 'downloadPdf'])->name('download.studi-kelayakan');


// User Routes
Route::prefix('user')->group(function () {
    // Rute untuk menyimpan Pakta Integritas
    Route::post('/integritas/store', [PaktaIntegritasController::class, 'store'])->name('integritas.store');

    // Rute untuk menyimpan laporan SPG (dapat diakses oleh user biasa)
    Route::post('/spg/lapor', [LaporSpgController::class, 'store'])->name('lapor.submit.user');

    // Rute untuk menyimpan Studi Kelayakan Pengguna (dapat diakses oleh user biasa)
    Route::post('/studi-kelayakan/store', [StudiKelayakanController::class, 'store'])->name('studi-kelayakan.store');
});


// Admin Authentication Routes
Route::get('/admin', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin Routes
Route::middleware(AdminMiddleware::class)->prefix('admin')->group(function () {
    Route::get('/api/getDataSurat', [PaktaIntegritasController::class, 'getDataSurat']);

    Route::post('/store', [AdminAuthController::class, 'storeAdmin'])->name('admin.store');
    Route::get('/account', [AdminAuthController::class, 'showAdminAccount'])->name('admin.account');
    Route::put('/update/{id}', [AdminAuthController::class, 'updateAdmin'])->name('admin.update');
    Route::delete('/{id}', [AdminAuthController::class, 'destroy'])->name('admin.destroy');

    Route::get('/home', [PaktaIntegritasController::class, 'index'])->name('admin.home');

    // StudiKelayakan
    Route::get('/studi-kelayakan', [StudiKelayakanController::class, 'index'])->name('studi-kelayakan.index');
    Route::get('/studi-kelayakan/add', [StudiKelayakanController::class, 'create'])->name('studi-kelayakan.add');
    Route::post('/studi-kelayakan/store', [StudiKelayakanController::class, 'store'])->name('studi-kelayakan.store.admin');
    Route::get('/studi-kelayakan/edit/{id}', [StudiKelayakanController::class, 'edit'])->name('studi-kelayakan.edit');
    Route::put('/studi-kelayakan/{id}', [StudiKelayakanController::class, 'update'])->name('studi-kelayakan.update');
    Route::delete('/studi-kelayakan/{id}', [StudiKelayakanController::class, 'destroy'])->name('studi-kelayakan.destroy');
    Route::get('/studi-kelayakan/export', [StudiKelayakanController::class, 'export'])->name('studi-kelayakan.export');
    Route::get('/studi-kelayakan/download-pdf/{id}', [StudiKelayakanController::class, 'downloadPdf'])->name('studi-kelayakan.download-pdf');
    Route::get('/studi-kelayakan/view/{id}', [StudiKelayakanController::class, 'viewLaporan'])->name('studi-kelayakan.view');

    // SPG Routes
    Route::get('/lapor/add', [LaporSpgController::class, 'create'])->name('lapor.add');
    Route::post('/lapor/store', [LaporSpgController::class, 'store'])->name('lapor.submit');
    Route::get('/lapor', [LaporSpgController::class, 'adminIndex'])->name('lapor.index');
    Route::get('/lapor/export/excel', [LaporSpgController::class, 'exportExcel'])->name('lapor-spg.export');
    Route::get('/lapor/export/pdf/{id}', [LaporSpgController::class, 'downloadPdf'])->name('laporan.pdf');
    Route::get('/lapor/edit/{id}', [LaporSpgController::class, 'edit'])->name('lapor-spg.edit');
    Route::put('/lapor/{id}', [LaporSpgController::class, 'update'])->name('lapor-spg.update');
    Route::delete('/lapor/{id}', [LaporSpgController::class, 'destroy'])->name('lapor-spg.destroy');

    Route::get('/{role?}', [PaktaIntegritasController::class, 'index'])->name('admin.role');
    Route::post('/add/{role}', [PaktaIntegritasController::class, 'store'])->name('integritas.store.admin');
    Route::get('/add/{role}', [PaktaIntegritasController::class, 'showForm'])->name('admin.add');
    Route::delete('/{role}/{id}', [PaktaIntegritasController::class, 'destroy'])->name('integritas.destroy');
    Route::get('/{role}/edit/{id}', [PaktaIntegritasController::class, 'edit'])->name('integritas.edit');
    Route::put('/{role}/{id}', [PaktaIntegritasController::class, 'update'])->name('integritas.update');
    Route::get('/{role}/export', [PaktaIntegritasController::class, 'export'])->name('integritas.export');
    Route::get('/{role}/download-pdf/{id}', [PaktaIntegritasController::class, 'downloadPdf'])->name('integritas.download-pdf');
    Route::get('/{role}/view-surat/{id}', [PaktaIntegritasController::class, 'viewSurat'])->name('integritas.view-surat');
});
