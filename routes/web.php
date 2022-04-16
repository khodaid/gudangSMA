<?php

use App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SatuanController;

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
Route::post('/login',[UserController::class, 'Login'])->name('login');
Route::post('/logout',[UserController::class, 'logout'])->name('logout');
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::get('/satuan',[SatuanController::class, 'index'])->name('satuan.index');
Route::post('/satuan',[SatuanController::class, 'store'])->name('satuan.store');
Route::get('/satuan/{satuan}/edit',[SatuanController::class, 'edit'])->name('satuan.edit');
Route::put('/satuan/{satuan}/update',[SatuanController::class, 'update'])->name('satuan.update');
Route::get('/satuan/{satuan}/show',[SatuanController::class, 'show'])->name('satuan.show');
Route::get('/satuan/{satuan}/destroy',[SatuanController::class, 'destroy'])->name('satuan.destroy');

Route::get('/barang',[BarangController::class, 'index'])->name('barang.index');

Route::get('/user',[UserController::class,'index'])->name('user.index');
Route::post('/user',[UserController::class,'store'])->name('user.store');
