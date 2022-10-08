<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Mail\EditEmail;
use App\Mail\EditSubscriptionNotification;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'role:user'])->except([]);
    }

    public function index()
    {
        $user = Auth::user();
        $bookings = [];
        $allowedBookings = [];
        $bookingsToShow = [];
        if ($user instanceof User) {
            $bookings = $user->bookings()->orderBy('id', 'desc')->take(30)->get();
        }

        // get the bookings that are not over date
        foreach ($bookings as $booking) {
            $isStillValid = false;
            $editions = $booking->editions()->get();
            foreach ($editions as $edition) {
                if (!(Carbon::createFromFormat('Y-m-d', $edition->endDate)->subDays(5)->isPast())) {
                    $isStillValid = true;
                }
            }
            if ($isStillValid) {
                array_push($bookingsToShow, $booking);
            }
        }

        // get all the bookings that are allowed to be deleted
        foreach ($bookingsToShow as $booking) {
            $isAllowd = true;
            $editions = $booking->editions()->get();
            foreach ($editions as $edition) {
                if (Carbon::createFromFormat('Y-m-d', $edition->endDate)->subDays(5)->isPast()) {
                    $isAllowd = false;
                }
            }
            if (!$isAllowd) {
                array_push($allowedBookings, $booking->id);
            }
        }
        $bookingsToShow = array_reverse($bookingsToShow);

        return view('/pages/dashboard', ['user' => $user,  'bookings' => $bookingsToShow, 'allowedBookings' => $allowedBookings]);
    }

    public function destroyBooking($id = null)
    {
        $booking = Booking::find($id);
        if ($booking === null || !$booking) {
            return back()->with('error', 'Er ging iets mis in het process');
        }
        $booking->delete();
        return back()->with('success', 'De reservering was successvol verwijdert');
    }

    public function updateUser(Request $request, $id = null)
    {
        $user = User::find($id);
        $valid =   $request->validate([
            'firstname' => ['required', 'string', 'max:255', 'min:3'],
            'lastname' => ['required', 'string', 'max:255', 'min:3'],
            'postcode' => 'required|postal_code:NL,DE,FR,BE',
            'house_number' => 'required',
            'city' => ['required', 'string', 'max:255', 'min:3'],
            'street_name' => ['required', 'string', 'max:255', 'min:3'],
            'gender' => ['required']
        ]);

        $user->firstname = $valid['firstname'];
        $user->lastname = $valid['lastname'];
        $user->postcode = $valid['postcode'];
        $user->house_number = $valid['house_number'];
        $user->city = $valid['city'];
        $user->street_name = $valid['street_name'];
        $user->gender = $valid['gender'];

        $user->save();

        return back()->with('success', 'Uw gegevens zijn successvol aangepast en opgeslagen');
    }

    public function updateUserEmail(Request $request)
    {

        $validation =  $request->validate([
            'old_email' =>  ['required', 'string', 'email', 'max:255',],
            'email' => ['required', 'email', 'max:255', 'min:4', 'different:old_email', 'unique:users']
        ]);

        $user = User::where('email', $request->old_email)->first();
        if ($user !== null) {
            $url = URL::temporarySignedRoute('editinfoEmail', now()->addDays(1), [
                'user' => $user->id,
                'email' => $validation['email'],
            ]);
            SendEmailJob::dispatch($user->email, new EditEmail($url, $user, $validation['email']));
            SendEmailJob::dispatch('knstadskrant@gmail.com', new EditSubscriptionNotification());
        } else {
            return back()->with('error', 'U heeft een verkeer e-mailadres opgegeven')->withInput();
        }
        Session::flush();
        Auth::logout();

        return redirect('/subscription/editFinalEmail');
    }
}