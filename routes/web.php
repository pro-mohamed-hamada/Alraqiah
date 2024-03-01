<?php

use App\Http\Controllers\Web\ComplaintsController;
use App\Http\Controllers\Web\WebsitesController;
use App\Http\Controllers\Web\FcmMessagesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\ClientsController;
use App\Http\Controllers\web\ComplaintReplayController as WebComplaintReplayController;
use App\Http\Controllers\Web\FaqsController;
use App\Http\Controllers\Web\RelativesController;
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
// Route::get('/test', function(){
//     $user = auth()->user();
//     $user->notify(new SendFcmNotification(['title'=>'test 1', 'content'=>'content 1']));
// });
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'dashboard','middleware'=>'auth'], function(){
    Route::resource('clients', ClientsController::class);
    Route::delete('relatives/{id}', [RelativesController::class, 'destroy'])->name('relatives.destroy');
    Route::resource('users', UsersController::class);
    Route::resource('videos', VideosController::class);
    Route::resource('faqs', FaqsController::class);
    Route::resource('websites', WebsitesController::class);
    Route::get('complaints', [ComplaintsController::class, 'index'])->name('complaints.index');
    Route::delete('complaints/{id}', [ComplaintsController::class, 'destroy'])->name('complaints.destroy');
    Route::post('complaints/{id}', [ComplaintsController::class, 'status'])->name('complaints.status');
    Route::post('complaint-replies', [WebComplaintReplayController::class, 'store'])->name('complaint-replies.store');
    Route::put('complaint-replies/{id}', [WebComplaintReplayController::class, 'update'])->name('complaint-replies.update');
    Route::delete('complaint-replies/{id}', [WebComplaintReplayController::class, 'destroy'])->name('complaint-replies.destroy');
    Route::resource('fcm-messages', FcmMessagesController::class);
    Route::resource('schedule-fcm', ScheduleFcmController::class);
});