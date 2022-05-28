<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\DanaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\KeluarController;
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
// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// })->name('dashboard');

Route::post('/login',[UserController::class, 'Login'])->name('login');
Route::post('/logout',[UserController::class, 'logout'])->name('logout');

Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/satuan',[SatuanController::class, 'index'])->name('satuan.index');
Route::post('/satuan',[SatuanController::class, 'store'])->name('satuan.store');
Route::get('/satuan/{satuan}/edit',[SatuanController::class, 'edit'])->name('satuan.edit');
Route::put('/satuan/{satuan}/update',[SatuanController::class, 'update'])->name('satuan.update');
Route::get('/satuan/{satuan}/show',[SatuanController::class, 'show'])->name('satuan.show');
Route::get('/satuan/{satuan}/destroy',[SatuanController::class, 'destroy'])->name('satuan.destroy');

Route::get('/barang',[BarangController::class, 'index'])->name('barang.index');
Route::post('/barang',[BarangController::class, 'store'])->name('barang.store');
Route::get('/barang/{barang}/edit',[BarangController::class, 'edit'])->name('barang.edit');
Route::put('/barang/{barang}/update',[BarangController::class, 'update'])->name('barang.update');
Route::get('/barang/{barang}/show',[BarangController::class, 'show'])->name('barang.show');
Route::get('/barang/{barang}/destroy',[BarangController::class, 'destroy'])->name('barang.destroy');
Route::post('/barang/export',[BarangController::class, 'export'])->name('barang.export');


Route::get('/masuk',[MasukController::class, 'index'])->name('masuk.index');
Route::post('/masuk',[MasukController::class, 'store'])->name('masuk.store');
Route::get('/masuk/{masuk}/edit',[MasukController::class, 'edit'])->name('masuk.edit');
Route::put('/masuk/{masuk}/update',[MasukController::class, 'update'])->name('masuk.update');
Route::get('/masuk/{masuk}/show',[MasukController::class, 'show'])->name('masuk.show');
Route::get('/masuk/{masuk}/destroy',[MasukController::class, 'destroy'])->name('masuk.destroy');
Route::get('/masuk/export',[MasukController::class, 'export_excel'])->name('masuk.export');

Route::get('/keluar',[KeluarController::class, 'index'])->name('keluar.index');
Route::post('/keluar',[KeluarController::class, 'store'])->name('keluar.store');
Route::get('/keluar/{keluar}/edit',[KeluarController::class, 'edit'])->name('keluar.edit');
Route::put('/keluar/{keluar}/update',[KeluarController::class, 'update'])->name('keluar.update');
Route::get('/keluar/{keluar}/show',[KeluarController::class, 'show'])->name('keluar.show');
Route::get('/keluar/{keluar}/destroy',[KeluarController::class, 'destroy'])->name('keluar.destroy');

Route::get('/dana',[DanaController::class, 'index'])->name('dana.index');
Route::post('/dana',[DanaController::class, 'store'])->name('dana.store');
Route::get('/dana/{dana}/edit',[DanaController::class, 'edit'])->name('dana.edit');
Route::put('/dana/{dana}/update',[DanaController::class, 'update'])->name('dana.update');
Route::get('/dana/{dana}/show',[DanaController::class, 'show'])->name('dana.show');
Route::get('/dana/{dana}/destroy',[DanaController::class, 'destroy'])->name('dana.destroy');

Route::get('/user',[UserController::class,'index'])->name('user.index');
Route::post('/user',[UserController::class,'store'])->name('user.store');
Route::get('/user/{user}/edit',[UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{user}/update',[UserController::class, 'update'])->name('user.update');
Route::get('/user/{user}/show',[UserController::class, 'show'])->name('user.show');
Route::get('/user/{user}/destroy',[UserController::class, 'destroy'])->name('user.destroy');

Route::get('/inventaris',[InventarisController::class,'index'])->name('inventaris.index');
Route::post('/inventaris',[InventarisController::class,'store'])->name('inventaris.store');
Route::get('/inventaris/{inventaris}/edit',[InventarisController::class, 'edit'])->name('inventaris.edit');
Route::put('/inventaris/{inventaris}/update',[InventarisController::class, 'update'])->name('inventaris.update');
Route::get('/inventaris/{inventaris}/show',[InventarisController::class, 'show'])->name('inventaris.show');
Route::put('/inventaris/{inventaris}/rusak',[InventarisController::class, 'rusak'])->name('inventaris.rusak');
Route::get('/inventaris/jumlah',[InventarisController::class, 'barang'])->name('inventaris.jumlah');
