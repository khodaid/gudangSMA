<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\DanaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KeluarController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\MasukController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SatuanController;
use App\Models\Inventaris;
use App\Models\Masuk;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
})->name('index');
Route::get('/login-public', function () {
    return view('login-pin');
})->name('loginPublic');

Route::post('/login', [UserController::class, 'Login'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/reset', function () {
    return view('reset-password');
})->name('reset.view');
Route::post('/reset', [UserController::class, 'reset'])->name('reset');
Route::post('/login-public', [UserController::class, 'loginPin'])->name('public.login');


Route::middleware('auth')->group(function () {

    Route::get('/cek', [BarangController::class, 'CekBarangPublic'])->name('cek-barang.index');
    Route::get('/cek/{barang}/show', [BarangController::class, 'show'])->name('cek-barang.show');

    Route::middleware('private')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

        Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
        Route::get('/barang/{barang}/show', [BarangController::class, 'show'])->name('barang.show');
        Route::post('/barang/export', [BarangController::class, 'export'])->name('barang.export');

        Route::get('/masuk', [MasukController::class, 'index'])->name('masuk.index');
        Route::get('/masuk/{masuk}/show', [MasukController::class, 'show'])->name('masuk.show');
        Route::post('/masuk/export', [MasukController::class, 'export'])->name('masuk.export');
        Route::get('/masuk/{masuk}/pdf', [MasukController::class, 'viewPdf'])->name('masuk.pdf');

        Route::get('/keluar', [KeluarController::class, 'index'])->name('keluar.index');
        Route::get('/keluar/{keluar}/show', [KeluarController::class, 'show'])->name('keluar.show');
        Route::post('/keluar/export', [KeluarController::class, 'export'])->name('keluar.export');

        Route::get('/dana', [DanaController::class, 'index'])->name('dana.index');
        Route::get('/dana/{dana}/show', [DanaController::class, 'show'])->name('dana.show');

        Route::get('/inventaris', [InventarisController::class, 'index'])->name('inventaris.index');
        Route::get('/inventaris/{inventaris}/show', [InventarisController::class, 'show'])->name('inventaris.show');
        Route::post('/inventaris/export', [InventarisController::class, 'export'])->name('inventaris.export');
        Route::get('/inventaris/{inventaris}/pdf', [InventarisController::class, 'viewPdf'])->name('inventaris.pdf');

        Route::middleware('admin')->group(function () {
            Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
            Route::get('/barang/{barang}/edit', [BarangController::class, 'edit'])->name('barang.edit');
            Route::put('/barang/{barang}/update', [BarangController::class, 'update'])->name('barang.update');
            Route::get('/barang/{barang}/destroy', [BarangController::class, 'destroy'])->name('barang.destroy');

            Route::post('/masuk', [MasukController::class, 'store'])->name('masuk.store');
            Route::get('/masuk/{masuk}/edit', [MasukController::class, 'edit'])->name('masuk.edit');
            Route::put('/masuk/{masuk}/update', [MasukController::class, 'update'])->name('masuk.update');
            Route::get('/masuk/{masuk}/destroy', [MasukController::class, 'destroy'])->name('masuk.destroy');

            Route::post('/keluar', [KeluarController::class, 'store'])->name('keluar.store');
            Route::get('/keluar/{keluar}/edit', [KeluarController::class, 'edit'])->name('keluar.edit');
            Route::put('/keluar/{keluar}/update', [KeluarController::class, 'update'])->name('keluar.update');
            Route::get('/keluar/{keluar}/destroy', [KeluarController::class, 'destroy'])->name('keluar.destroy');

            Route::post('/dana', [DanaController::class, 'store'])->name('dana.store');
            Route::get('/dana/{dana}/edit', [DanaController::class, 'edit'])->name('dana.edit');
            Route::put('/dana/{dana}/update', [DanaController::class, 'update'])->name('dana.update');
            Route::get('/dana/{dana}/destroy', [DanaController::class, 'destroy'])->name('dana.destroy');

            Route::post('/inventaris', [InventarisController::class, 'store'])->name('inventaris.store');
            Route::get('/inventaris/{inventaris}/edit', [InventarisController::class, 'edit'])->name('inventaris.edit');
            Route::put('/inventaris/{inventaris}/update', [InventarisController::class, 'update'])->name('inventaris.update');
            Route::put('/inventaris/{inventaris}/rusak', [InventarisController::class, 'rusak'])->name('inventaris.rusak');
        });

        Route::middleware('super')->group(function () {
            Route::get('/satuan', [SatuanController::class, 'index'])->name('satuan.index');
            Route::post('/satuan', [SatuanController::class, 'store'])->name('satuan.store');
            Route::get('/satuan/{satuan}/edit', [SatuanController::class, 'edit'])->name('satuan.edit');
            Route::put('/satuan/{satuan}/update', [SatuanController::class, 'update'])->name('satuan.update');
            Route::get('/satuan/{satuan}/show', [SatuanController::class, 'show'])->name('satuan.show');
            Route::get('/satuan/{satuan}/destroy', [SatuanController::class, 'destroy'])->name('satuan.destroy');

            Route::get('/user', [UserController::class, 'index'])->name('user.index');
            Route::post('/user', [UserController::class, 'store'])->name('user.store');
            Route::post('/user/public', [UserController::class, 'storePublic'])->name('user.storePublic');
            Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
            Route::put('/user/{user}/update', [UserController::class, 'update'])->name('user.update');
            Route::get('/user/{user}/show', [UserController::class, 'show'])->name('user.show');
            Route::get('/user/{user}/destroy', [UserController::class, 'destroy'])->name('user.destroy');

            Route::get('/lokasi', [LokasiController::class, 'index'])->name('lokasi.index');
            Route::post('/lokasi', [LokasiController::class, 'store'])->name('lokasi.store');
            Route::get('/lokasi/{lokasi}/edit', [LokasiController::class, 'edit'])->name('lokasi.edit');
            Route::put('/lokasi/{lokasi}/update', [LokasiController::class, 'update'])->name('lokasi.update');
            Route::get('/lokasi/{lokasi}/show', [LokasiController::class, 'show'])->name('lokasi.show');
            Route::get('/lokasi/{lokasi}/destroy', [LokasiController::class, 'destroy'])->name('lokasi.destroy');

            Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
            Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
            Route::get('/kategori/{kategori}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
            Route::put('/kategori/{kategori}/update', [KategoriController::class, 'update'])->name('kategori.update');
            Route::get('/kategori/{kategori}/show', [KategoriController::class, 'show'])->name('kategori.show');
            Route::get('/kategori/{kategori}/destroy', [KategoriController::class, 'destroy'])->name('kategori.destroy');
        });
    });
});
