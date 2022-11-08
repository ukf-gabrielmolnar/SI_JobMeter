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

Route::get('/register', 'App\Http\Controllers\RegisterController@registerUser')->name('register.user');
Route::post('/register/user', 'App\Http\Controllers\RegisterController@storeUser')->name('store.user');

Route::get('/login', 'App\Http\Controllers\UserController@login')->name('login.login');
Route::post('/login', 'App\Http\Controllers\UserController@auth')->name('login.auth');

Route::get('/logout', 'App\Http\Controllers\UserController@logout')->name('user.logout');

Route::get('/praxReg', 'App\Http\Controllers\DashboardController@praxRegistration')->name('praxReg');
Route::get('/companies', 'App\Http\Controllers\DashboardController@companies')->name('companies');

Route::get('/members', 'App\Http\Controllers\DashboardController@members')->name('members');

Route::get('/adminView','App\Http\Controllers\AdminController@index')->name('adminView');
//Route::get('/adminView', 'App\Http\Controllers\AdminController@destroy');
Route::post('/adminView', 'App\Http\Controllers\AdminController@destroy')->name('admin.destroy');
//Route::post('/admin', 'App\Http\Controllers\AdminController@asd')->name('admin.asd');
Route::resource('adminView', \App\Http\Controllers\AdminController::class);



