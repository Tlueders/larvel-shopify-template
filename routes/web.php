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
    return view('welcome');
});

require __DIR__.'/auth.php';

Route::get('/dashboard', 'App\Http\Controllers\CustomersController@index')->middleware(['auth'])->name('dashboard');

Route::get('login/shopify', 'App\Http\Controllers\Auth\LoginShopifyController@redirectToProvider')->name('login.shopify');;
Route::get('login/shopify/callback', 'App\Http\Controllers\Auth\LoginShopifyController@handleProviderCallback');
