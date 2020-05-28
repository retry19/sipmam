<?php

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


Route::group(['middleware' => 'guest'], function() {
    Route::get('/', function() {
        return 'index <a href="/login">klik disini</a> untuk login, halaman home user ny blum buat 😔';
    });
    Route::livewire('/login', 'auth.login')->name('auth.login')
        ->layout('layouts.auth');
});


Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {
    Route::get('/', function() { return view('layouts.app'); })->name('dashboard');
    Route::livewire('/order', 'pelayan.order-index')->name('order.index');
    Route::livewire('/pesanan', 'pelayan.pesanan-index')->name('pesanan.index');

    Route::get('/ajax/pesanan/{id}/list', 'AjaxController@detailPesanan');
});
