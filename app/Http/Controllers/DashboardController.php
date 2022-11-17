<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Mail\EditEmail;
use App\Mail\PasswordChangeReminder;
use App\Mail\UserEditNotification;
use App\Models\Booking;
use App\Models\Edition;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules;

class DashboardController extends Controller
{

    public function __construct()
    {
    }

    public function personInformationIndex()
    {
        $user = Auth::user();
        return view('/pages/dashboard/customer/dashboardPersonInformation', ['user' => $user]);
    }

    public function personSecurityIndex()
    {
        $user = Auth::user();
        return view('/pages/dashboard/customer/dashboardSecurity', ['user' => $user]);
    }

    public function personReservationsIndex()
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
        return view('/pages/dashboard/customer/dashboardReservations', ['user' => $user, 'bookings' => $bookingsToShow, 'allowedBookings' => $allowedBookings]);
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
        SendEmailJob::dispatch('knstadskrant@gmail.com', new UserEditNotification($user->id));
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
        } else {
            return back()->with('error', 'U heeft een verkeer e-mailadres opgegeven')->withInput();
        }
        Session::flush();
        Auth::logout();

        return redirect('/subscription/editFinalEmail');
    }


    public function updateUserPassword(Request $request)
    {
        $user = Auth::user();
        $validation =  $request->validate([
            'old_password' =>  ['required'],
            'new_password' => ['required', 'max:40', 'min:4', 'different:old_password', Rules\Password::defaults()]
        ]);

        if (Hash::check($validation['old_password'], $user->password)) {

            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->new_password)
            ]);
            Session::flush();
            Auth::logout();
            SendEmailJob::dispatch($user->email, new PasswordChangeReminder());
            return redirect('/changedPasswordNotification');
        } else {
            return back()->with('error', 'U heeft een verkeer wachtwoord opgegeven opgegeven')->withInput();
        }
    }

    public function changedPasswordNotification()
    {
        $title = 'UW WACHTWOORD IS GEWIJZIGD';
        $text = 'U ontvangt een email met confirmatie dat uw wachtwoord is aangepast. U kunt nu overnieuw inloggen met uw nieuwe wachtwoord';
        return view('/pages/subscription/endingSubscription', ['title' => $title, 'text' => $text]);
    }

    //TODO de juiste gegevens in de html table zetten en het verwijderen maken
    public function indexUsers()
    {
        $users = User::orderBy('created_at', 'desc')->simplePaginate(10);
        return view('/pages/dashboard/admin/users/usersIndex', ['users' => $users]);
    }

    public function indexUser($id)
    {
        $user = User::find($id);
        return view('/pages/dashboard/admin/users/userIndex', ['user' => $user]);
    }

    function sortFunction($a, $b)
    {
        return strtotime($a[1]) - strtotime($b[1]);
    }

    //TODO de juiste gegevens in de html table zetten en het create maken en verwijderen
    public function indexEditions()
    {
        $editions = Edition::orderBy('endDate', 'desc')->simplePaginate(10);

        $date = Carbon::now();
        $futureDate = Carbon::now()->addMonths(2);
        $upcomingEditions =  Edition::whereBetween('endDate',  [$date, $futureDate])->get();
        $dates = [];
        foreach ($upcomingEditions as $edition) {
            $dates[$edition->id] = $edition->beginDateUpload;
        }

        $nearestDate = min($dates);
        $currentEditionId = array_search($nearestDate, $dates);
        unset($dates[$currentEditionId]);

        $currentEdition = Edition::where('id', $currentEditionId)->first();
        $upcomingEdition = Edition::where('id', array_key_first($dates))->first();

        return view('/pages/dashboard/admin/editions/editionsIndex', ['editions' => $editions, 'currentEdition' => $currentEdition, 'upcomingEdition' => $upcomingEdition]);
    }

    public function indexEdition($id)
    {
        $edition = Edition::find($id);
        $bookings = $edition->bookings()->paginate(10);
        return view('/pages/dashboard/admin/editions/editionIndex', ['edition' => $edition, 'bookings' => $bookings]);
    }

    public function indexBookings()
    {
        $bookings = Booking::orderBy('created_at', 'desc')->simplePaginate(10);
        return view('/pages/dashboard/admin/editions/bookingsIndex', ['bookings' => $bookings]);
    }

    public function indexBooking($id)
    {

        $booking = Booking::find($id);
        $files = $booking->files()->get();
        return view('/pages/dashboard/admin/editions/bookingIndex', ['booking' => $booking, 'files' => $files]);
    }
}
