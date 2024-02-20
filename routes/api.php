<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CitiesController;
use App\Http\Controllers\Api\ClientHistoriesController;
use App\Http\Controllers\Api\GovernoratesController;
use App\Http\Controllers\Api\ClientsController;
use App\Http\Controllers\Api\ClientServicesController;
use App\Http\Controllers\Api\FaqsController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\ServicesController;
use App\Http\Controllers\Api\RatesController;

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

Route::group(['middleware'=>['auth:sanctum', 'localization']], function(){
    Route::post('logout',      [AuthController::class, 'logout']);
    Route::get('profile',      [AuthController::class, 'profile']);
    Route::get('rates', [RatesController::class, 'index']);
    Route::post('rates', [RatesController::class, 'store']);

    Route::get('home', HomeController::class);
    Route::get('faq', FaqsController::class);
    Route::post('location', [ClientsController::class, 'location']);
    Route::post('subscribe', [ClientsController::class, 'subscribe']);

});