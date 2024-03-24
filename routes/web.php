<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
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

Route::get('/', function () {
    return view('welcome');
});



Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{id}/delete', [UserController::class, 'destroy'])->name('users');
    Route::get('/users/{id}', [UserController::class, 'edit'])->name('users');
    Route::patch('/users/{id}', [UserController::class, 'update']);

    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
    Route::post('/kategori', [KategoriController::class, 'store']);
    Route::get('/kategori/{id}/delete', [KategoriController::class, 'destroy'])->name('kategori');
    Route::get('/kategori/{id}', [KategoriController::class, 'edit'])->name('kategori');
    Route::patch('/kategori/{id}', [KategoriController::class, 'update']);

    Route::get('/barang', [BarangController::class, 'index'])->name('barang');
    Route::post('/barang', [BarangController::class, 'store']);
    Route::get('/barang/{id}/delete', [BarangController::class, 'destroy'])->name('barang');
    Route::get('/barang/{id}', [BarangController::class, 'edit'])->name('barang');
    Route::patch('/barang/{id}', [BarangController::class, 'update']);
});

Route::get('/logout', [LoginController::class, 'destroy']);
