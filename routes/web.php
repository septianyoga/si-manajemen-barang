<?php

use App\Http\Controllers\ApprovePesananController;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EOQController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\SupplierController;
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

    Route::group(['middleware' => 'userAkses:Direktur'], function () {
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::post('/users', [UserController::class, 'store']);
        Route::get('/users/{id}/delete', [UserController::class, 'destroy'])->name('users');
        Route::get('/users/{id}', [UserController::class, 'edit'])->name('users');
        Route::patch('/users/{id}', [UserController::class, 'update']);
    });

    Route::group(['middleware' => 'userAkses:Supply Chain'], function () {
        Route::get('/barang', [BarangController::class, 'index'])->name('barang');
        Route::post('/barang', [BarangController::class, 'store']);
        Route::get('/barang/{id}/delete', [BarangController::class, 'destroy'])->name('barang');
        Route::get('/barang/{barang}', [BarangController::class, 'edit'])->name('barang');
        Route::patch('/barang/{id}', [BarangController::class, 'update']);

        Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier');
        Route::post('/supplier', [SupplierController::class, 'store']);
        Route::get('/supplier/{id}/delete', [SupplierController::class, 'destroy'])->name('supplier');
        Route::get('/supplier/{id}', [SupplierController::class, 'edit'])->name('supplier');
        Route::patch('/supplier/{id}', [SupplierController::class, 'update']);

        Route::get('/bahan_baku', [BahanBakuController::class, 'index'])->name('bahan_baku');
        Route::post('/bahan_baku', [BahanBakuController::class, 'store']);
        Route::get('/bahan_baku/{id}/delete', [BahanBakuController::class, 'destroy'])->name('bahan_baku');
        Route::get('/bahan_baku/{id}', [BahanBakuController::class, 'edit'])->name('bahan_baku');
        Route::patch('/bahan_baku/{id}', [BahanBakuController::class, 'update']);

        Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan');
        Route::post('/pemesanan', [PemesananController::class, 'store']);
        Route::get('/pemesanan/{id}/delete', [PemesananController::class, 'destroy'])->name('pemesanan');
        Route::get('/pemesanan/{id}', [PemesananController::class, 'edit'])->name('pemesanan');
        Route::patch('/pemesanan/{id}', [PemesananController::class, 'update']);
        Route::get('/pemesanan/konfirmasi/{id}', [PemesananController::class, 'konfirmasi'])->name('pemesanan');

        Route::get('/eoq', [EOQController::class, 'index'])->name('eoq');
        Route::get('/eoq/{id}', [EOQController::class, 'show'])->name('eoq');
    });

    Route::group(['middleware' => 'userAkses:Finance'], function () {
        Route::get('/approve_pesanan', [ApprovePesananController::class, 'index'])->name('approve_pesanan');
        Route::get('/approve_pesanan/{id}/approve', [ApprovePesananController::class, 'destroy'])->name('approve_pesanan');
    });
});

Route::get('/logout', [LoginController::class, 'destroy']);
