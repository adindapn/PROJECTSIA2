<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PembelianController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource( '/user' , UserController::class);
Route::get('/user/hapus/{id}', [UserController::class, 'destroy']);

Route::resource('/barang', BarangController::class);
Route::get('/barang/hapus/{id}', [BarangController::class, 'destroy']);

Route::resource('/supplier', SupplierController::class);
Route::get('/supplier/hapus/{id}', [SupplierController::class, 'destroy']);

// Akun
Route::resource('/akun', AkunController::class);
Route::get('/akun/edit/{id}', [AkunController::class, 'edit']);
Route::get('/akun/hapus/{id}', [AkunController::class, 'destroy']);

// Setting
Route::get('/setting', [App\Http\Controllers\SettingController::class, 'index'])->name('setting.transaksi');
Route::post('/setting/simpan', [App\Http\Controllers\SettingController::class, 'simpan']);

// Pemesanan
Route::get('/transaksi', [App\Http\Controllers\PemesananController::class, 'index'])->name('pemesanan.transaksi');
Route::post('/sem/store', [App\Http\Controllers\PemesananController::class, 'store']);
Route::get('/transaksi/hapus/{kd_brg}', [App\Http\Controllers\PemesananController::class, 'destroy']);

// Detail Pesan
Route::post('/detail/store', [App\Http\Controllers\DetailPesanController::class, 'store']);
Route::post('/detail/simpan', [App\Http\Controllers\DetailPesanController::class, 'simpan']);

// Pembelian
Route::get('/pembelian', [App\Http\Controllers\PembelianController::class, 'index'])->name('pembelian.transaksi');
Route::get('/laporan/faktur/{invoice}', [App\Http\Controllers\PembelianController::class, 'pdf'])->name('cetak.order_pdf');
Route::get('/pembelian-beli/{id}', [App\Http\Controllers\PembelianController::class, 'edit']);
Route::get('/pembelian/hapus/{id}', [App\Http\Controllers\PembelianController::class, 'destroy']);
Route::post('/pembelian/simpan', [App\Http\Controllers\PembelianController::class, 'simpan']);

// Retur
Route::get('/retur', [App\Http\Controllers\ReturController::class, 'index'])->name('retur.transaksi');
Route::get('/retur-beli/{id}', [App\Http\Controllers\ReturController::class, 'edit']);
Route::post('/retur/simpan', [App\Http\Controllers\ReturController::class, 'simpan']);

// Laporan
Route::resource('/laporan', App\Http\Controllers\LaporanController::class);

// Laporan cetak
Route::get('/laporancetak/cetak_pdf', [App\Http\Controllers\LaporanController::class, 'cetak_pdf']);

// Lapstok
Route::resource('/stok', App\Http\Controllers\LapstokController::class);