<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EggController;
use App\Http\Controllers\HutangController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('icon', function (){
    return view('icon');
});

Route::controller(DashboardController::class)->group(function() {
    Route::get('dashboard', 'index')->middleware('staff', 'auth')->name('dashboard');
    Route::get('/', 'index')->middleware('staff', 'auth', 'admin')->name('home');
});


Route::controller(UserController::class)->group(function () {
    Route::get('user', 'index')->middleware('staff', 'auth', 'admin')->name('user');
    Route::get('user/password', 'password')->middleware('staff', 'auth')->name('user.password');
    Route::get('store/update', 'store')->middleware('staff', 'auth', 'admin')->name('user.store');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'index')->middleware('guest')->name('login');
    Route::post('authenticate', 'authenticate')->middleware('guest')->name('authenticate');
    Route::post('logout', 'logout')->middleware('staff', 'auth')->name('logout');
});

Route::controller(MedicineController::class)->group(function() {
    Route::get('medicine', 'index')->middleware('staff', 'auth', 'admin')->name('medicine');
    Route::get('medicine/settings', 'settings')->middleware('staff', 'auth', 'admin')->name('medicine.settings');
    Route::get('medicine/transaksi', 'transaksi')->middleware('staff', 'auth', 'admin')->name('medicine.transaksi');
});

Route::controller(EggController::class)->group(function () {
    Route::get('egg', 'index')->middleware('staff', 'auth', 'admin')->name('egg');
    Route::get('egg/{id}/inbound', 'inbound')->middleware('staff', 'auth', 'admin')->name('egg.inbound');
    Route::get('egg/{id}/outbound', 'outbound')->middleware('staff', 'auth', 'admin')->name('egg.outbound');
    Route::get('egg/{id}/mutasi', 'mutasi')->middleware('staff', 'auth', 'admin')->name('egg.mutasi');
    Route::get('egg/report', 'report')->middleware('staff', 'auth', 'admin')->name('egg.report');
    Route::get('report-egg/in', 'laporanTelurMasuk')->middleware('staff', 'auth', 'admin')->name('egg.laporanTelurMasuk');
});

Route::controller(HutangController::class)->group(function() {
    Route::get('hutang', 'index')->middleware('staff', 'auth')->name('hutang');
    Route::get('buyer/', 'buyer')->middleware('staff', 'auth')->name('hutang.buyer');
    Route::get('buyer/{id}/detail', 'buyerDetail')->middleware('staff', 'auth')->name('hutang.buyerDetail');
    Route::get('hutang/{id}/detail', 'detail')->middleware('staff', 'auth')->name('hutang.detail');
    Route::get('debt', 'debt')->middleware('staff', 'auth')->name('debt');
    Route::get('debt/{id}/detail', 'debtdetail')->middleware('staff', 'auth')->name('debtdetail');
    Route::get('upah/buruh', 'upahBuruh')->middleware('staff', 'auth')->name('upahBuruh');
    Route::get('/hutang/harga-telur', 'hargaTelur')->middleware('auth', 'staff')->name('hargaTelur');
});

Route::controller(TransaksiController::class)->group(function() {
    Route::get('transaksi', 'penjualan')->middleware('staff', 'auth')->name('transaksi');
    Route::get('transaksi/{id}/pos', 'pos')->middleware('staff', 'auth')->name('transaksi.pos');
    Route::get('inbound', 'inbound')->middleware('staff', 'auth')->name('inbound');
    Route::get('inbound/transaksi', 'transaksi')->middleware('staff', 'auth')->name('inbound.transaksi');
    Route::get('invoice/{id}/print', 'invoicePrint')->name('print.invoice');
});

Route::get('developers', function (){
    return response()->json([
        'status'    => 200,
        'ok'        => true,
        'message'   => 'Developers Info',
        'data'      => [
            'name'      => 'Fajar Ramadana',
            'email'     => 'fajarramadana25@gmail.com',
            'phone'     => '0895330078691',
            'github'    => 'https://github.com/fajarbit25',
            'company'   => 'PT. Purnama Sinar Gemilang',
        ]
    ]);
});

Route::prefix('admin/setting')->middleware('admin')->group(function () {
    Route::controller(SettingController::class)->group(function () {
        Route::get('set-price', 'setPrice')->name('setPrice');
        Route::get('set-categories', 'setCategories')->name('setCategories');
    });
});