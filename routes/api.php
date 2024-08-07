<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClientsController;
use App\Http\Controllers\Api\ComplaintReplayController;
use App\Http\Controllers\Api\ComplaintsController;
use App\Http\Controllers\Api\FaqsController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\LiveMessageController;
use App\Http\Controllers\Api\NotificationsController;
use App\Http\Controllers\Api\RatesController;
use App\Http\Controllers\Api\RelativesController;
use App\Http\Controllers\Api\SitesController;
use App\Http\Controllers\Api\UsersController;

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
Route::post('check-phone', [AuthController::class, 'checkPhone']);

Route::group(['middleware'=>'auth:sanctum'], function(){
    Route::post('logout',      [AuthController::class, 'logout']);
    Route::get('profile',      [AuthController::class, 'profile']);
    Route::post('profile-logo', [AuthController::class, 'updateProfileLogo']);
    Route::post('relatives-profile-logo/{id}', [RelativesController::class, 'updateProfileLogo']);
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
    Route::get('users', [UsersController::class, 'getSupervisors']);// get the supervisors data
    Route::get('sites', SitesController::class);
    Route::post('location', [UsersController::class, 'location']);
    Route::post('subscribe', [ClientsController::class, 'subscribe']);
    Route::get('notifications', [NotificationsController::class, 'index']);
    Route::delete('notifications/{id}', [NotificationsController::class, 'destroy']);
    Route::put('notifications-read/{id}', [NotificationsController::class, 'markAsRead']);
    Route::get('live-messages', [LiveMessageController::class, 'index']);
    Route::post('live-messages', [LiveMessageController::class, 'store']);

    Route::get('clients-qrcode/{qrcode}', [ClientsController::class, 'findByQrcode']);
    Route::put('clients/update-chronic-disease', [ClientsController::class, 'updateChronicDisease']);
    Route::put('relatives/update-chronic-disease/{id}', [RelativesController::class, 'updateChronicDisease']);
    Route::post('check-points', function(){
        $lat = request()->lat;
        $lng = request()->lng;
        return isPointInPolygon($lat, $lng);
    });
});
