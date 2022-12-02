<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManagerController;

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

Route::get('/', 'App\Http\Controllers\DashboardController@index')->name('dashboard.index');

Route::get('/register', 'App\Http\Controllers\RegisterController@registerUser')->name('register.user');
Route::post('/register/user', 'App\Http\Controllers\RegisterController@storeUser')->name('store.user');

Route::get('/login', 'App\Http\Controllers\UserController@login')->name('login.login');
Route::post('/login', 'App\Http\Controllers\UserController@auth')->name('login.auth');

Route::get('/logout', 'App\Http\Controllers\UserController@logout')->name('user.logout');
Route::get('/userInfo','App\Http\Controllers\UserController@profileInfo' )->name('user.userInfo');
Route::get('/userSettings' ,'App\Http\Controllers\UserController@profileSettings')->name('user.userSettings');
Route::post('/userUpdate','App\Http\Controllers\UserController@update')->name('user.update');

Route::get('/praxReg', 'App\Http\Controllers\DashboardController@praxRegistration')->name('praxReg');

Route::resource('contract', \App\Http\Controllers\ContractController::class);

//Route::get('/members', 'App\Http\Controllers\DashboardController@members')->name('members');

Route::get('/adminView','App\Http\Controllers\AdminController@index')->name('adminView');
//Route::get('/adminView', 'App\Http\Controllers\AdminController@destroy');
//Route::post('/delete', 'App\Http\Controllers\AdminController@destroy')->name('admin.destroy');
Route::resource('admin',\App\Http\Controllers\AdminController::class);

Route::get('/manager', [App\Http\Controllers\ManagerController::class, 'index'])->name('manager.index');
Route::get('/manager/users',[App\Http\Controllers\ManagerController::class,'showusers'])->name('manager.show_users');
Route::get('/manager/companies',[App\Http\Controllers\ManagerController::class,'showcompanies'])->name('manager.show_companies');
Route::get('/manager/contracts',[App\Http\Controllers\ManagerController::class,'showcontracts'])->name('manager.show_contracts');
Route::resource('manager', ManagerController::class);

Route::get('/jobAdd', 'App\Http\Controllers\AddJobController@index')->name('job.jobAdd');
Route::post('/jobSave','App\Http\Controllers\AddJobController@saveData')->name('job.saveData');
Route::get('/jobList','App\Http\Controllers\JobController@index')->name('job.jobList');

Route::get('/unapprovedContracts', 'App\Http\Controllers\ContractController@index')->name('ppp.unapprovedContracts');
Route::get('/approveContracts', 'App\Http\Controllers\ContractController@update')->name('ppp.approveContracts');

//grafy
Route::get('/graf_1', [\App\Http\Controllers\GrafController::class, 'years_graph'])->name('graf.graf_1');
Route::get('/graf_2', [\App\Http\Controllers\GrafController::class, 'companies_graph'])->name('graf.graf_2');

Route::get('/filterContracts', 'App\Http\Controllers\ContractController@applyFilters')->name('ppp.filterContracts');
Route::get('/archiveContracts', 'App\Http\Controllers\ContractController@showArchive')->name('ppp.archiveContracts');
Route::get('/downloadPDF', [\App\Http\Controllers\ContractController::class, 'savePDF'])->name('ppp.contractsPDF');

Route::get('/feedbackContracts', 'App\Http\Controllers\FeedbackReportController@index')->name('ppp.feedbackContracts');
Route::get('/addFeedback', 'App\Http\Controllers\FeedbackReportController@store')->name('ppp.saveFeedback');

Route::get('/feedback', 'App\Http\Controllers\StudentFeedbackController@index')->name('feedback.feedback');
Route::post('/feedback/store', 'App\Http\Controllers\StudentFeedbackController@store')->name('feedback.store');


