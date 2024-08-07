<?php

use App\Events\ComplaintCountEvent;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Web\ComplaintsController;
use App\Http\Controllers\Web\SitesController;
use App\Http\Controllers\Web\FcmMessagesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\ClientsController;
use App\Http\Controllers\Web\ComplaintReplayController;
use App\Http\Controllers\Web\FaqsController;
use App\Http\Controllers\Web\LocalizationController;
use App\Http\Controllers\Web\RatesController;
use App\Http\Controllers\Web\RelativesController;
use App\Http\Controllers\Web\ScheduleFcmController;
use App\Http\Controllers\Web\SettingsController;
use App\Http\Controllers\Web\VideosController;
use App\Http\Controllers\Web\UsersController;
use App\Models\Client;
use App\Models\ScheduleFcm;
use App\Notifications\GeneralNotification;
use App\Notifications\SendEmailNotification;
use App\Notifications\SendFcmNotification;
use Illuminate\Support\Facades\Auth;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;

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
    // $scheduleFcm = ScheduleFcm::first();
    // $users[0] = Auth::user();
    // ScheduleFcm::UserReminderFcm(scheduleFcm: $scheduleFcm, users: $users);
    // $user = Auth::user();
    // $notificationData = ['title'=>'this is the title', 'content'=>'this is the content'];
    // $user->notify(new SendEmailNotification(message: 'this is the message'));
    // return "Done";
// });
Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');
Route::get('/test', function(){
    $qrcode = Client::first()->qrcode;
    $d = new DNS2D();
    return $d->getBarcodeHTML($qrcode, 'QRCODE');
});
Route::group(['prefix'=>'dashboard','middleware'=>'auth'], function(){
    Route::resource('clients', ClientsController::class);
    Route::delete('clients-delete-multiple',[ ClientsController::class, 'deleteMultiple'])->name('clients.delete_multiple');
    Route::put('clients-reassign/{id}', [ClientsController::class, 'reassignClients'])->name('clients.reassign');
    Route::get('clients-import', [ClientsController::class, 'importView'])->name('clients.import_view');
    Route::post('clients-import', [ClientsController::class, 'import'])->name('clients.import');
    Route::get('users-import', [UsersController::class, 'importView'])->name('users.import_view');
    Route::post('users-import', [UsersController::class, 'import'])->name('users.import');
    Route::get('client-relatives/{id}', [ClientsController::class, 'clientRelatives'])->name('client.relatives');
    Route::delete('relatives/{id}', [RelativesController::class, 'destroy'])->name('relatives.destroy');
    Route::resource('users', UsersController::class);
    Route::get('supervisor-clients/{id}', [UsersController::class, 'supervisorClients'])->name('supervisor.clients');
    Route::get('profile', [UsersController::class, 'profileView'])->name('profile.view');
    Route::put('profile', [UsersController::class, 'profile'])->name('profile.update');
    Route::resource('videos', VideosController::class);
    Route::post('videos/{id}', [VideosController::class, 'status'])->name('videos.status');
    Route::resource('faqs', FaqsController::class);

    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('settings/{id}', [SettingsController::class, 'update'])->name('settings.update');

    Route::get('rates', [RatesController::class, 'index'])->name('rates.index');
    Route::delete('rates/{id}', [RatesController::class, 'destroy'])->name('rates.destroy');
    Route::post('rates/{id}', [RatesController::class, 'status'])->name('rates.status');

    Route::resource('sites', SitesController::class);
    Route::get('complaints', [ComplaintsController::class, 'index'])->name('complaints.index');
    Route::delete('complaints/{id}', [ComplaintsController::class, 'destroy'])->name('complaints.destroy');
    Route::post('complaints/{id}', [ComplaintsController::class, 'status'])->name('complaints.status');
    Route::post('complaint-replies', [ComplaintReplayController::class, 'store'])->name('complaint-replies.store');
    Route::get('complaint-replies/{id}', [ComplaintsController::class, 'complaintReplies'])->name('complaint.replies');
    Route::put('complaint-replies/{id}', [ComplaintReplayController::class, 'update'])->name('complaint-replies.update');
    Route::delete('complaint-replies/{id}', [ComplaintReplayController::class, 'destroy'])->name('complaint-replies.destroy');
    Route::resource('fcm-messages', FcmMessagesController::class)->except('show');
    Route::get('live-fcm', [FcmMessagesController::class, 'liveFcmMessageView'])->name('fcm.liveFcmMessageView');
    Route::post('live-fcm', [FcmMessagesController::class, 'liveFcmMessage'])->name('fcm.liveFcmMessage');
    Route::resource('schedule-fcm', ScheduleFcmController::class)->except('show');

    Route::get('lang/{locale}',LocalizationController::class)->name('lang');
});
