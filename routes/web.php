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

Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('home');

Route::get('/register/staff', 'App\Http\Controllers\RegisterController@registerStaff')->name('register.staff');
Route::post('/register/staff', 'App\Http\Controllers\RegisterController@storeStaff')->name('store.staff');

Route::get('/login', 'App\Http\Controllers\UserController@login')->name('user.login');
Route::post('/login', 'App\Http\Controllers\UserController@auth')->name('user.auth');

Route::get('/logout', 'App\Http\Controllers\UserController@logout')->name('user.logout');

Route::get('/members', 'App\Http\Controllers\DashboardController@members')->name('members');
