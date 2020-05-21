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

Route::get('/', function () {
    return view('layouts.app');
})->name('dashboard');

Route::livewire('/login', 'auth.login')->name('auth.login')
    ->layout('layouts.auth');

Route::group(['middleware' => 'auth'], function () {
    
});
