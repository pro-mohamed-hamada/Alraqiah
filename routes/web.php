<?php

use App\Http\Controllers\Web\FcmMessagesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\ClientsController;
use App\Http\Controllers\Web\FaqsController;
use App\Http\Controllers\Web\ScheduleFcmController;
use App\Http\Controllers\Web\VideosController;
use App\Http\Controllers\Web\UsersController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes(['register' => false]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'dashboard','middleware'=>'auth'], function(){
    Route::resource('clients', ClientsController::class);
    // Route::resource('relatives', Relatives::class);
    Route::resource('users', UsersController::class);
    Route::resource('videos', VideosController::class);
    Route::resource('faqs', FaqsController::class);
    Route::resource('fcm-messages', FcmMessagesController::class);
    Route::resource('schedule-fcm', ScheduleFcmController::class);
});