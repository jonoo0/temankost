<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangKeluarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\RakController;
use App\Http\Controllers\VariasiController;
use App\Http\Controllers\KostController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\PenghuniController;
use App\Http\Controllers\JenisKostController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\AjaxSelect;

// use App\Http\Controllers\CustomerController;

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.auth');
Route::post('/register-post', [AuthController::class, 'register_post'])->name('register.store');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout.auth');

Route::get('/cs/kost', [CustomerController::class, 'kost'])->name('customer.kost');
Route::get('/cs/detail/{id}', [CustomerController::class, 'show'])->name('customer.kost-detail');



Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/cekk', [HomeController::class, 'cek'])->name('home.cek');


Route::get('/profile', [AuthController::class, 'profile'])->name('user.profile');
Route::post('/store/password', [AuthController::class, 'ubahpwstore'])->name('ubahpwstore');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => ['cekrole:Penghuni']], function () {

    Route::post('/pesanan/store', [PesananController::class, 'store'])->name('pesanan.store');
    Route::get('/pesanan/pembayaran', [PesananController::class, 'pembayaran'])->name('pesanan.pembayaran');
    Route::put('/pesanan/pembayaran/update/{id}', [PesananController::class, 'update'])->name('pembayaran.update');
    Route::get('/akun/pesanan', [PesananController::class, 'index'])->name('cs.pesanan.index');
    // Route::get('/cs/order', [PesananController::class, 'order'])->name('cs.pesanan.order');

});
});

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => ['cekrole:Admin,Pemilik']], function () {

        Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
        Route::post('/pesanan/pembayaran/konfirmasi', [PesananController::class, 'konfirmasi'])->name('pembayaran.konfirmasi');


    // kost
    Route::get('/kost', [KostController::class, 'index'])->name('kost.index');
    Route::get('/kost/create', [KostController::class, 'create'])->name('kost.create');
    Route::get('/kost/variasi/{id}', [KostController::class, 'variasi'])->name('vi.create');
    Route::get('/kost/edit/variasi/{id}', [KostController::class, 'variasi'])->name('a.edit');
    Route::get('/kost/edit/{id}', [KostController::class, 'edit'])->name('kost.edit');
    Route::get('/kost/detail/{kost}', [KostController::class, 'show'])->name('kost.detail');
    Route::get('/kost/detail-penghuni/{kost}', [KostController::class, 'detail_penghuni'])->name('kost.detail-penghuni');
    Route::POST('/kost/store', [KostController::class, 'store'])->name('kost.store');
    Route::put('/kost/update/{id}', [KostController::class, 'update'])->name('kost.update');
    Route::post('/kost/delete', [KostController::class, 'destroy'])->name('kost.delete');

    // pemilik
    Route::get('/pemilik', [PemilikController::class, 'index'])->name('pemilik.index');
    Route::get('/pemilik/create', [PemilikController::class, 'create'])->name('pemilik.create');
    Route::get('/pemilik/edit/{id}', [PemilikController::class, 'edit'])->name('pemilik.edit');
    Route::POST('/pemilik/store', [PemilikController::class, 'store'])->name('pemilik.store');
    Route::put('/pemilik/update/{id}', [PemilikController::class, 'update'])->name('pemilik.update');
    Route::post('/pemilik/delete', [PemilikController::class, 'destroy'])->name('pemilik.delete');

    // penghuni
    Route::get('/penghuni', [PenghuniController::class, 'index'])->name('penghuni.index');
    Route::get('/penghuni/create', [PenghuniController::class, 'create'])->name('penghuni.create');
    Route::get('/penghuni/edit/{id}', [PenghuniController::class, 'edit'])->name('penghuni.edit');
    Route::POST('/penghuni/store', [PenghuniController::class, 'store'])->name('penghuni.store');
    Route::put('/penghuni/update/{id}', [PenghuniController::class, 'update'])->name('penghuni.update');


    Route::post('ajax-select/notif', [AjaxSelect::class, 'notif'])->name('notif');
    Route::post('ajax-select/notif-admin', [AjaxSelect::class, 'notif_admin'])->name('notif.admin');



    // jenis
    Route::get('/jenis', [JenisKostController::class, 'index'])->name('jenis.index');
    Route::POST('/jenis/store', [JenisKostController::class, 'store'])->name('jenis.store');
    Route::put('/jenis/update/{id}', [JenisKostController::class, 'update'])->name('jenis.update');
    Route::post('/jenis/delete', [JenisKostController::class, 'destroy'])->name('jenis.delete');




});
});

