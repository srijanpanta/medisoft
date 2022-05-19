<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardController;

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

Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::put('/home',[App\Http\Controllers\HomeController::class, 'update'])->name('home.update');

Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

Route::get('location-user', [LocationController::class, 'index']);
Route::resource('reports', ReportController::class)->middleware('auth');

Route::get('change-password', [ChangePasswordController::class,'index'])->name('changePassword.index');
Route::post('change-password', [ChangePasswordController::class,'store'])->name('changePassword.update');
