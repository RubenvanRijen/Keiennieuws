<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DesignController;
use App\Http\Controllers\EditionsDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserDashboardController;
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
Route::get('/home', [HomeController::class, 'index'])->name('homepage');
Route::get('/information', [HomeController::class, 'informationIndex']);
Route::post('/home/volunteerapplication', [HomeController::class, 'volunteerApplication']);
Route::post('/home/uploadpicture', [HomeController::class, 'photoUpload']);

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

//bookings
Route::get('/placebooking', [BookingController::class, 'indexBooking']);
Route::post('/placebooking', [BookingController::class, 'createBooking']);
Route::get('/successactionbooking', [BookingController::class, 'successBooking']);
Route::post('/placedbooking/success/{user}/{email}/{title}/{size}/{type}/{edition}')->name('bookingsuccess')->middleware('signed');
Route::get('/placedbooking/success/{user}/{email}/{title}/{size}/{type}/{edition}', [BookingController::class, 'checkTokenBooking']);

//publications
Route::post('/placepublicationSigned/{user_id}/{booking_id}')->name('publicationSigned')->middleware('signed');
Route::get('/placepublicationSigned/{user_id?}/{booking_id?}', [PublicationController::class, 'indexSigned']);
Route::get('/placepublication', [PublicationController::class, 'index']);
Route::post('/placepublication', [PublicationController::class, 'store']);
Route::get('/successactionpublication', [PublicationController::class, 'successPublication']);

//dashboard
Route::middleware(['auth', 'verified', 'role:user|admin'])->group(
    function () {
        //person information
        Route::get('/dashboard/person-information', [DashboardController::class, 'personInformationIndex']);
        Route::patch('/dashboard/person-information/edit/{id}', [DashboardController::class, 'updateUser']);
        //security
        Route::get('/dashboard/person-security', [DashboardController::class, 'personSecurityIndex']);
        Route::post('/dashboard/person-security/editEmail/{id}', [DashboardController::class, 'updateUserEmail']);
        Route::post('/dashboard/person-security/password/{id}', [DashboardController::class, 'updateUserPassword']);
        //reservations
        Route::get('/dashboard/person-reservations', [DashboardController::class, 'personReservationsIndex']);
        Route::delete('/dashboard/person-reservations/delete/{id}', [DashboardController::class, 'destroyBooking']);
    }
);
Route::get('/changedPasswordNotification', [DashboardController::class, 'changedPasswordNotification']);

//admin
Route::middleware(['role:admin', 'auth', 'verified'])->group(
    function () {
        //users
        Route::get('/dashboard/admin/users', [UserDashboardController::class, 'indexUsers']);
        Route::get('/dashboard/admin/user-add', [UserDashboardController::class, 'addUser']);
        Route::post('/dashboard/admin/user-add', [UserDashboardController::class, 'postUser']);
        Route::get('/dashboard/admin/user-info/{id}', [UserDashboardController::class, 'indexUser']);
        Route::get('/dashboard/admin/user-edit/{id}', [UserDashboardController::class, 'editUser']);
        Route::patch('/dashboard/admin/user-edit/{id}', [UserDashboardController::class, 'updateUser']);
        Route::delete('/dashboard/admin/user-delete/{id}', [UserDashboardController::class, 'deleteUser']);

        //editions
        Route::get('/dashboard/admin/editions', [EditionsDashboardController::class, 'indexEditions']);
        Route::get('/dashboard/admin/edition-add', [EditionsDashboardController::class, 'addEdition']);
        Route::post('/dashboard/admin/edition-add', [EditionsDashboardController::class, 'postEdition']);
        Route::get('/dashboard/admin/edition-info/{id}', [EditionsDashboardController::class, 'indexEdition']);
        Route::get('/dashboard/admin/edition-edit/{id}', [EditionsDashboardController::class, 'editEdition']);
        Route::patch('/dashboard/admin/edition-edit/{id}', [EditionsDashboardController::class, 'updateEdition']);
        Route::delete('/dashboard/admin/edition-delete/{id}', [EditionsDashboardController::class, 'deleteEdition']);

        //bookings
        Route::get('/dashboard/admin/bookings', [EditionsDashboardController::class, 'indexBookings']);
        Route::get('/dashboard/admin/booking-info/{id}', [EditionsDashboardController::class, 'indexBooking']);
        Route::get('/dashboard/admin/booking-info/{id}/download/public/{fileName}', [EditionsDashboardController::class, 'downloadFile']);
        Route::delete('/dashboard/admin/booking-delete/{id}', [EditionsDashboardController::class, 'deleteBooking']);


        //design
        Route::get('/dashboard/admin/design-edit', [DesignController::class, 'index']);
    }
);

require __DIR__ . '/auth.php';
