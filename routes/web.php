<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KepsekController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PanitiaController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\TuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalikelasController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::group(["middleware" => ['auth:sanctum', 'verified']], function () {
    Route::view('/dashboard', "dashboard")->name('dashboard');

    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('/user', [UserController::class, 'index'])->name('user');
        Route::view('/user/new', 'pages.user.user-new')->name('user.new');
        Route::get('/userrole', [UserController::class, 'index_role'])->name('user.role');
        Route::get('/role', [UserController::class, 'role_view'])->name('role');
        Route::get('/menu', [MenuController::class, 'index'])->name('menu');
        Route::get('/gunabayar', [AdminController::class, 'gunabayar'])->name('gunabayar');
    });
    Route::group(['middleware' => ['role:tata usaha']], function () {
        Route::get('/kelas', [TuController::class, 'kelas'])->name('kelas');
        Route::get('/siswa', [TuController::class, 'siswa'])->name('siswa');
        Route::get('/pembayaran', [TuController::class, 'pembayaran'])->name('pembayaran');
        Route::get('/pembayaransppperkelastu', [TuController::class, 'pembayaransppperkelas'])->name('pembayaransppperkelastu');
        Route::get('/pembayaranperkelastu', [TuController::class, 'pembayaranperkelas'])->name('pembayaranperkelastu');
        Route::get('/pembayaran/new', [TuController::class, 'pembayarannew'])->name('pembayaran.new');
        Route::get('/pembayaranpt', [TuController::class, 'pembayaranpt'])->name('pembayaranpt');
        Route::get('/pengeluaran', [TuController::class, 'pengeluaran'])->name('pengeluaran');
        Route::get('/keuangan', [TuController::class, 'keuangan'])->name('keuangan');
        Route::get('/keterangan', [TuController::class, 'keterangan'])->name('keterangan');
        Route::get('/keterangan/new', [TuController::class, 'keterangannew'])->name('keterangan.new');
        Route::get('/naikkelas', [TuController::class, 'naikkelas'])->name('naikkelas');
        Route::resource('tu', 'App\Http\Controllers\TuController');
    });
    Route::group(['middleware' => ['role:panitia']], function () {
        Route::get('/pembayaranp', [PanitiaController::class, 'pembayaranp'])->name('pembayaranp');
        Route::get('/keuanganp', [PanitiaController::class, 'keuanganp'])->name('keuanganp');
        Route::get('/pembayaranperkelasp', [PanitiaController::class, 'pembayaranperkelas'])->name('pembayaranperkelasp');
        Route::resource('print', 'App\Http\Controllers\PrintController');
    });
    Route::group(['middleware' => ['role:wali kelas']], function () {
        Route::get('/cetakpdf', [WalikelasController::class, 'cetakpdf'])->name('cetakpdf');
        Route::get('/savepdf/{id}/{uas}/{pas}/{pat}', [WalikelasController::class, 'savepdf'])->name('savepdf');
        Route::get('/pembayaranperkelasw', [WalikelasController::class, 'pembayaranperkelas'])->name('pembayaranperkelasw');
        Route::get('/pembayaransppperkelasw', [WalikelasController::class, 'pembayaransppperkelas'])->name('pembayaransppperkelasw');
    });
    Route::group(['middleware' => ['role:kepala sekolah']], function () {
        Route::get('/keuangank', [KepsekController::class, 'keuangan'])->name('keuangank');
        Route::get('/keuanganpk', [KepsekController::class, 'keuanganp'])->name('keuanganpk');
        Route::get('/pembayaranperkelask', [KepsekController::class, 'pembayaranperkelas'])->name('pembayaranperkelask');
        Route::get('/pembayaransppperkelask', [KepsekController::class, 'pembayaransppperkelas'])->name('pembayaransppperkelask');
    });
});
