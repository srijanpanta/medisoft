<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\AdminController;




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
Route::resource('reports', ReportController::class)->middleware('auth')->middleware('checkStatus');
Route::resource('doctors', DoctorController::class);

Route::get('change-password', [ChangePasswordController::class,'index'])->name('changePassword.index');
Route::post('change-password', [ChangePasswordController::class,'store'])->name('changePassword.update');

Route::resource('friends',FriendshipController::class)->middleware('auth')->middleware('checkStatus');

Route::get('checkup',function(){
    return view('checkup');
})->name('checkup')->middleware('auth')->middleware('checkStatus');

Route::get('send', [App\Http\Controllers\HomeController::class, 'sendNotification']);
Route::get('friendRequestNotification', [App\Http\Controllers\HomeController::class, 'friendRequestNotification'])->name('friendRequestNotification');
Route::get('sendAcceptedNotification', [App\Http\Controllers\HomeController::class, 'sendAcceptedNotification'])->name('sendAcceptedNotification');
Route::get('notifications', [App\Http\Controllers\HomeController::class, 'getNotifications'])->name('notifications');
Route::get('readMsg', [App\Http\Controllers\HomeController::class, 'readNotifications'])->name('readMsg');
Route::get('readMsgSingle/{notificationId}', [App\Http\Controllers\HomeController::class, 'readNotificationsSingle'])->name('readMsgSingle');

Route::post('newsletter', NewsletterController::class);

Route::get('disease',[DiseaseController::class,'index'])->name('disease');
Route::get('disease\{diseaseName}',[DiseaseController::class,'place'])->name('disease.place');

Route::group(['middleware' => 'can:isAdmin'], function () {
        Route::get('newdoctors',[AdminController::class,'newDoctor'])->name('newDoctors');
        Route::get('showdoctor/{doctor}',[AdminController::class,'showDoctor'])->name('showDoctor');
        Route::put('acceptdoctor/{doctor}',[AdminController::class,'acceptDoctor'])->name('acceptDoctor');

});