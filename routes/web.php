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

Route::get('/register/staff', 'App\Http\Controllers\RegisterController@registerStaff')->name('register.staff');
Route::post('/register/staff', 'App\Http\Controllers\RegisterController@storeStaff')->name('store.staff');

Route::get('/login/staff', 'App\Http\Controllers\LoginController@loginStaff')->name('login.staff');
