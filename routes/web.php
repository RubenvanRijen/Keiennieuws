<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubscriptionController;
use App\Models\Subscription;
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
//home
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);
Route::get('/information', [HomeController::class, 'informationIndex']);
Route::post('/home/volunteerapplication', [HomeController::class, 'volunteerApplication']);

//subscriptions
Route::get('/subscription', [SubscriptionController::class, 'index']);
//START
Route::get('/subscription/startstepone', [SubscriptionController::class, 'startStepOne']);
Route::get('/subscription/startsteptwo',    [SubscriptionController::class, 'startStepTwo']);
Route::post('/subscription/startsteptwo', [SubscriptionController::class, 'startStepTwoForm']);
Route::get('/subscription/startfinal', [SubscriptionController::class, 'startFinal']);
Route::post('/subscription/start/{user}')->name('subscribe')->middleware('signed');
Route::get('/subscription/start/{user}', [SubscriptionController::class, 'checkTokenStart']);
//END
Route::get('/subscription/endstepone', [SubscriptionController::class, 'endStepOne']);
Route::get('/subscription/endsteptwo', [SubscriptionController::class, 'endStepTwo']);
Route::post('/subscription/endsteptwo', [SubscriptionController::class, 'endStepTwoForm']);
Route::get('/subscription/endfinal', [SubscriptionController::class, 'endFinal']);
Route::post('/subscription/end/{user}')->name('unsubscribe')->middleware('signed');
Route::get('/subscription/end/{user}', [SubscriptionController::class, 'checkTokenStop']);
//EDIT
Route::get('/subscription/editstepone', [SubscriptionController::class, 'editStepOne']);
Route::get('/subscription/editsteptwoadress', [SubscriptionController::class, 'editAdress']);
Route::post('/subscription/editsteptwoadress', [SubscriptionController::class, 'editAdressForm']);
Route::get('/subscription/editsteptwoemail', [SubscriptionController::class, 'editEmail']);
Route::post('/subscription/editsteptwoemail', [SubscriptionController::class, 'editEmailForm']);
Route::get('/subscription/editFinalAdress', [SubscriptionController::class, 'editFinalAdress']);
Route::get('/subscription/editFinalEmail', [SubscriptionController::class, 'editFinalEmail']);
Route::post('/subscription/editAdress/{user}/{email}/{city}/{street_name}/{postcode}/{house_number}')->name('editinfoAdress')->middleware('signed');
Route::get('/subscription/editAdress/{user}/{email}/{city}/{street_name}/{postcode}/{house_number}', [SubscriptionController::class, 'checkTokenEditAdress']);
Route::post('/subscription/editEmail/{user}/{email}')->name('editinfoEmail')->middleware('signed');
Route::get('/subscription/editEmail/{user}/{email}', [SubscriptionController::class, 'checkTokenEditEmail']);

Route::get('/placebooking', [BookingController::class, 'indexBooking']);
Route::post('/placebooking', [BookingController::class, 'createBooking']);
Route::get('/successactionbooking', [BookingController::class, 'successBooking']);
Route::post('/placedbooking/success/{user}/{email}/{title}/{size}/{type}/{editions}')->name('bookingsuccess')->middleware('signed');
Route::get('/placedbooking/success/{user}/{email}/{title}/{size}/{type}/{editions}', [BookingController::class, 'checkTokenBooking']);

Route::get('/placepublication', function () {
    return view('/pages/placePublication');
});

Route::post('/placepublication', function () {
    return redirect('/successactionpublication');
});

Route::get('/successactionpublication', function () {
    return view('/pages/successAction', ['title' => 'UW PUBLICATIE IS GEUPLOAD!', 'text' => 'Uw bestand word zo spoedig mogelijk verwerkt']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
