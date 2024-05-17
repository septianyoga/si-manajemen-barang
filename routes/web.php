<?php

use App\Http\Controllers\ApprovePesananController;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EOQController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PermintaanBarangController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SafetyStockController;
use App\Http\Controllers\StockOpnameController;
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
    return view('landingpage');
});



Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::post('/profil', [ProfilController::class, 'store']);

    Route::group(['middleware' => 'userAkses:Direktur'], function () {
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::post('/users', [UserController::class, 'store']);
        Route::get('/users/{id}/delete', [UserController::class, 'destroy'])->name('users');
        Route::get('/users/{id}', [UserController::class, 'edit'])->name('users');
        Route::patch('/users/{id}', [UserController::class, 'update']);
    });

    Route::group(['middleware' => 'userAkses:Direktur,Supply Chain'], function () {
        Route::get('/laporan_pemesanan', [LaporanController::class, 'laporanPemesanan'])->name('laporan_pemesanan');
        Route::get('/laporan_pemesanan/cetak', [LaporanController::class, 'cetakPemesanan'])->name('laporan_pemesanan');
        Route::get('/laporan_permintaan', [LaporanController::class, 'laporanPermintaan'])->name('laporan_permintaan');
        Route::get('/laporan_permintaan/cetak', [LaporanController::class, 'cetakPermintaan'])->name('laporan_permintaan');
        Route::get('/laporan_barang', [LaporanController::class, 'laporanBarang'])->name('laporan_barang');
        Route::get('/laporan_barang/cetak', [LaporanController::class, 'cetakBarang'])->name('laporan_barang');
        Route::get('/laporan_bahan_baku', [LaporanController::class, 'laporanBahanBaku'])->name('laporan_bahan_baku');
        Route::get('/laporan_bahan_baku/cetak', [LaporanController::class, 'cetakBahanBaku'])->name('laporan_bahan_baku');
        Route::get('/laporan_stock_opname', [LaporanController::class, 'laporanStockOpname'])->name('laporan_stock_opname');
        Route::get('/laporan_stock_opname/cetak', [LaporanController::class, 'cetakStockOpname'])->name('laporan_stock_opname');
    });

    Route::group(['middleware' => 'userAkses:Supply Chain'], function () {
        Route::get('/barang', [BarangController::class, 'index'])->name('barang');
        Route::post('/barang', [BarangController::class, 'store']);
        Route::get('/barang/{id}/delete', [BarangController::class, 'destroy'])->name('barang');
        Route::get('/barang/{barang}', [BarangController::class, 'edit'])->name('barang');
        Route::patch('/barang/{id}', [BarangController::class, 'update']);
        Route::post('/barang/tambahi/{id}', [BarangController::class, 'tambahStok']);
        Route::post('/barang/kurangi/{id}', [BarangController::class, 'kurangStok']);

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
        Route::get('/pemesanan/selesai/{id}', [PemesananController::class, 'selesai'])->name('pemesanan');


        Route::get('/eoq', [EOQController::class, 'index'])->name('eoq');
        Route::get('/eoq/{id}', [EOQController::class, 'show'])->name('eoq');

        Route::get('/approve_permintaan', [PermintaanBarangController::class, 'approvePermintaan'])->name('approve_permintaan');
        Route::get('/approve_permintaan/{id}', [PermintaanBarangController::class, 'prosesApprove'])->name('approve_permintaan');

        Route::get('/barang_masuk', [BarangController::class, 'barangMasuk'])->name('barang_masuk');
        Route::get('/barang_keluar', [BarangController::class, 'barangKeluar'])->name('barang_keluar');

        Route::get('/safety_stock', [SafetyStockController::class, 'index'])->name('safety_stock');
        Route::post('/safety_stock/hitung/{id}', [SafetyStockController::class, 'update']);
        Route::get('/safety_stock/rop/{id}', [SafetyStockController::class, 'hitungROP']);

        Route::get('/stock_opname', [StockOpnameController::class, 'index'])->name('stock_opname');
        Route::post('/stock_opname', [StockOpnameController::class, 'store']);
        Route::post('/stock_opname/{id}', [StockOpnameController::class, 'update']);
        Route::get('/stock_opname/{id}/delete', [StockOpnameController::class, 'destroy'])->name('stock_opname');
    });

    Route::group(['middleware' => 'userAkses:Finance'], function () {
        Route::get('/approve_pesanan', [ApprovePesananController::class, 'index'])->name('approve_pesanan');
        Route::get('/approve_pesanan/{id}/approve', [ApprovePesananController::class, 'destroy'])->name('approve_pesanan');
        Route::post('/approve_pesanan/reject', [ApprovePesananController::class, 'reject'])->name('reject_pesanan');

        Route::get('/keuangan', [KeuanganController::class, 'index'])->name('keuangan');
    });

    Route::group(['middleware' => 'userAkses:Sales'], function () {
        Route::get('/permintaan_barang', [PermintaanBarangController::class, 'index'])->name('permintaan_barang');
        Route::post('/permintaan_barang', [PermintaanBarangController::class, 'store'])->name('permintaan_barang');
        Route::get('/permintaan_barang/{id}', [PermintaanBarangController::class, 'selesai'])->name('permintaan_barang');
    });
});

Route::get('/logout', [LoginController::class, 'destroy']);
Route::get('/cetak_po/{id}', [PemesananController::class, 'cetakPO'])->name('cetak_po');
