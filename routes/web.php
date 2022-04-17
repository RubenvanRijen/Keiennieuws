<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubscriptionController;
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

//subscriptions
Route::get('/subscription', [SubscriptionController::class, 'index']);
//START
Route::get('/subscription/startstepone', [SubscriptionController::class, 'startStepOne']);
Route::get('/subscription/startsteptwo',    [SubscriptionController::class, 'startStepTwo']);
Route::post('/subscription/startsteptwo', [SubscriptionController::class, 'startStepTwoForm']);
Route::get('/subscription/startfinal', [SubscriptionController::class, 'startFinal']);
//END
Route::get('/subscription/endstepone', [SubscriptionController::class, 'endStepOne']);
Route::get('/subscription/endsteptwo', [SubscriptionController::class, 'endStepTwo']);
Route::post('/subscription/endsteptwo', [SubscriptionController::class, 'endStepTwoForm']);
Route::get('/subscription/endfinal', [SubscriptionController::class, 'endFinal']);
//EDIT
Route::get('/subscription/editstepone', [SubscriptionController::class, 'editStepOne']);
Route::get('/subscription/editsteptwoadress', [SubscriptionController::class, 'editAdress']);
Route::post('/subscription/editsteptwoadress', [SubscriptionController::class, 'editAdressForm']);
Route::get('/subscription/editsteptwoemail', [SubscriptionController::class, 'editEmail']);
Route::post('/subscription/editsteptwoemail', [SubscriptionController::class, 'editEmailForm']);
Route::get('/subscription/editFinalAdress', [SubscriptionController::class, 'editFinalAdress']);
Route::get('/subscription/editFinalEmail', [SubscriptionController::class, 'editFinalEmail']);

Route::get('/placebooking', function () {
    return view('/pages/placeBooking');
});

Route::post('/placebooking', function () {
    return redirect('/successactionbooking');
});

Route::get('/successactionbooking', function () {
    return view('/pages/successAction', ['title' => 'BEDANKT VOOR UW RESERVATIE!', 'text' => 'U zult binnen enkele minuten een bevestigingsmail ontvangen']);
});





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
