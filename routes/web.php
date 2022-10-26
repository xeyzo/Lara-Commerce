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

Route::get('/', 'App\Http\Controllers\Utama@index');
Route::get('/Login', 'App\Http\Controllers\Login@index');
Route::post('/Daftar', 'App\Http\Controllers\Login@register');
Route::post('/signIn', 'App\Http\Controllers\Login@signIn');
Route::get('/Logout', 'App\Http\Controllers\Login@logout');
Route::post('/addCart', 'App\Http\Controllers\Order@order');
Route::get('/Keranjang', 'App\Http\Controllers\Order@cart');
Route::get('/Checkout', 'App\Http\Controllers\Order@checkout');
Route::get('/Checkout_list', 'App\Http\Controllers\Order@checkoutList');
Route::get('/Confirm', 'App\Http\Controllers\Order@confirm');
Route::post('/Konfirmasi', 'App\Http\Controllers\Order@saveConfirm');









