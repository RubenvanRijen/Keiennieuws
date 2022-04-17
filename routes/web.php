<?php

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

Route::get('/', function () {
    return view('/pages/home');
});

Route::get('/home', function () {
    return view('/pages/home');
});

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



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
