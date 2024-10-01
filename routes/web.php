<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EggController;
use App\Http\Controllers\HutangController;
use App\Http\Controllers\MedicineController;
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
    Route::get('dashboard', 'index')->middleware('auth')->name('dashboard');
    Route::get('/', 'index')->middleware('auth')->name('home');
});


Route::controller(UserController::class)->group(function () {
    Route::get('user', 'index')->middleware('auth')->name('user');
    Route::get('user/password', 'password')->middleware('auth')->name('user.password');
    Route::get('store/update', 'store')->middleware('auth')->name('user.store');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'index')->middleware('guest')->name('login');
    Route::post('authenticate', 'authenticate')->middleware('guest')->name('authenticate');
    Route::post('logout', 'logout')->middleware('auth')->name('logout');
});

Route::controller(MedicineController::class)->group(function() {
    Route::get('medicine', 'index')->middleware('auth')->name('medicine');
    Route::get('medicine/settings', 'settings')->middleware('auth')->name('medicine.settings');
    Route::get('medicine/transaksi', 'transaksi')->middleware('auth')->name('medicine.transaksi');
});

Route::controller(EggController::class)->group(function () {
    Route::get('egg', 'index')->middleware('auth')->name('egg');
    Route::get('egg/inbound', 'inbound')->middleware('auth')->name('egg.inbound');
    Route::get('egg/outbound', 'outbound')->middleware('auth')->name('egg.outbound');
    Route::get('egg/{id}/mutasi', 'mutasi')->middleware('auth')->name('egg.mutasi');
    Route::get('egg/report', 'report')->middleware('auth')->name('egg.report');
});

Route::controller(HutangController::class)->group(function() {
    Route::get('hutang', 'index')->middleware('auth')->name('hutang');
    Route::get('hutang/{id}/detail', 'detail')->middleware('auth')->name('hutang.detail');
    Route::get('debt', 'debt')->middleware('auth')->name('debt');
    Route::get('debt/{id}/detail', 'debtdetail')->middleware('auth')->name('debtdetail');
    Route::get('upah/buruh', 'upahBuruh')->middleware('auth')->name('upahBuruh');
});

Route::controller(TransaksiController::class)->group(function() {
    Route::get('transaksi', 'penjualan')->middleware('auth')->name('transaksi');
    Route::get('transaksi/pos', 'pos')->middleware('auth')->name('transaksi.pos');
    Route::get('inbound', 'inbound')->middleware('auth')->name('inbound');
    Route::get('inbound/transaksi', 'transaksi')->middleware('auth')->name('inbound.transaksi');
    Route::get('invoice/{id}/print', 'invoicePrint')->name('print.invoice');
});