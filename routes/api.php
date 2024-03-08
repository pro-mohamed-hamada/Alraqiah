<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClientsController;
use App\Http\Controllers\Api\ComplaintReplayController;
use App\Http\Controllers\Api\ComplaintsController;
use App\Http\Controllers\Api\FaqsController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\NotificationsController;
use App\Http\Controllers\Api\RatesController;
use App\Http\Controllers\Api\SitesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware'=>'auth:sanctum'], function(){
    Route::post('logout',      [AuthController::class, 'logout']);
    Route::get('profile',      [AuthController::class, 'profile']);
    Route::post('profile-logo', [AuthController::class, 'updateProfileLogo']);
    Route::get('rates', [RatesController::class, 'index']);
    Route::post('rates', [RatesController::class, 'store']);

    Route::get('complaints', [ComplaintsController::class, 'index']);
    Route::post('complaints', [ComplaintsController::class, 'store']);
    Route::put('complaints/{id}', [ComplaintsController::class, 'update']);
    Route::delete('complaints/{id}', [ComplaintsController::class, 'destroy']);

    Route::post('complaint-replies', [ComplaintReplayController::class, 'store']);
    Route::put('complaint-replies/{id}', [ComplaintReplayController::class, 'update']);
    Route::delete('complaint-replies/{id}', [ComplaintReplayController::class, 'destroy']);

    Route::get('home', HomeController::class);
    Route::get('faq', FaqsController::class);
    Route::get('sites', SitesController::class);
    Route::post('location', [ClientsController::class, 'location']);
    Route::post('subscribe', [ClientsController::class, 'subscribe']);
    Route::get('notifications', [NotificationsController::class, 'index']);
    Route::delete('notifications/{id}', [NotificationsController::class, 'destroy']);
    Route::put('notifications-read/{id}', [NotificationsController::class, 'markAsRead']);

});