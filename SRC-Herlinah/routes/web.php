<?php

use App\Http\Controllers\pemilikController;
use App\Http\Controllers\staffController;
use App\Http\Controllers\userController;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// -------------- START - LOGIN - LUPA PASSWORD - RESET PASSWORD --------------
Route::get('/', function () {
    return view('login');
});
Route::post('/login', [userController::class, 'login']);
Route::get('/resetPassword', function () {
    return view('reset_password');
});


// -------------- PROFILE --------------
Route::get('/profilePemilik', [userController::class, 'dashPemilikToko']);
Route::post('/profilePemilik', [userController::class, 'profilePemilik']);
Route::get('/profileStaff', [userController::class, 'dashStaffToko']);
Route::post('/profileStaff', [userController::class, 'profileStaff']);
Route::post('/gantiPasswordPemilik', [userController::class, 'gantiPasswordPemilik']);
Route::post('/gantiPasswordStaff', [userController::class, 'gantiPasswordStaff']);

// -------------- PEMILIK TOKO --------------
Route::get('/pemilikToko', [pemilikController::class, 'home']);
// -------------- DATA STAFF TOKO --------------
Route::get('/dataStaff', [pemilikController::class, 'dataStaff']);
Route::get('/tambahStaff', [pemilikController::class, 'createStaff']);
Route::post('/tambahStaff', [pemilikController::class, 'tambahStaff']);
Route::get('/editStaff/{staff}', [pemilikController::class, 'editStaff']);
Route::post('/editStaff', [pemilikController::class, 'saveEditStaff']);
Route::post('/deleteStaff/{id_user}', [pemilikController::class, 'deleteStaff']);

// -------------- DATA BARANG --------------
Route::get('/dataBarang', [pemilikController::class, 'dataBarang']);
Route::get('/tambahBarang', [pemilikController::class, 'createBarang']);
Route::post('/tambahBarang', [pemilikController::class, 'tambahBarang']);
Route::get('/editBarang/{barang}', [pemilikController::class, 'editBarang']);
Route::post('/editBarang', [pemilikController::class, 'saveEditBarang']);
Route::get('/deleteBarang/{id_barang}', [pemilikController::class, 'deleteBarang']);

// -------------- Barang Masuk -------------------
Route::get('/tambahBarangMasuk', [pemilikController::class, 'createBarangMasuk']);
Route::get('/barangmasuk/{id_pembelian}', [pemilikController::class, 'updateBarangMasuk']);
Route::post('/tambahBarangMasuk', [pemilikController::class, 'tambahBarangMasuk']);
Route::post('/updateBarangMasuk', [pemilikController::class, 'saveEditBarangMasuk']);
Route::get('/deleteBarangMasuk/{id_pembelian}', [pemilikController::class, 'deleteBarangMasuk']);


// -------------- EDIT TRANSAKSI & REPORT --------------
Route::get('/viewReport', [pemilikController::class, 'showLaporan']);
Route::get('/viewReportPembelian', [pemilikController::class, 'showLaporanPembelian']);
Route::get('/report/{awal}/{akhir}', [pemilikController::class, 'cetakLaporan']);


Route::post('/cetak', function () {
    return view('pages.pemilik_toko.cetak');
});

// -------------- STAFF TOKO --------------
Route::get('/staffToko', [staffController::class, 'index']);
Route::get('/transaksi', [staffController::class, 'createTransaksi']);
Route::post('/transaksi', [staffController::class, 'transaksi']);
Route::get('/transaksi/{id_transaksi}', [staffController::class, 'updateTransaksi']);
Route::post('/transaksi/update', [staffController::class, 'editTransaksi']);
Route::get('/transaksi/delete/{id_transaksi}', [pemilikController::class, 'deleteTransaksi']);
Route::post('/penjualan/delete', [staffController::class, 'deleteItem']);
Route::get('/printStruk/{id_transaksi}', [staffController::class, 'cetakNota']);
