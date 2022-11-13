<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Mail\BookingCreation;
use App\Mail\NewReservationNotification;
use App\Mail\PublicationUploadLink;
use App\Models\Booking;
use App\Models\Edition;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;

class BookingController extends Controller
{

    public function indexBooking()
    {
        $date = date("Y/m/d");
        $user = Auth::user();
        $types = Booking::getEnumType();
        $sizes = Booking::getEnumSize();
        $editions = Edition::whereDate('endDateUpload', '>=', $date)->orderBy('endDateUpload', 'asc')->paginate(12);

        return view('/pages/placeBooking', ['user' => $user, 'sizes' => $sizes, 'types' => $types, 'editions' => $editions]);
    }

    public function createBooking(Request $request)
    {
        $result =  $this->generateBooking($request, false);
        if ($result) {
            return $result;
        }
        return redirect('/successactionbooking');
    }

    public static function validationForBooking(Request $request)
    {
        $found = null;
        $fullEdition = null;
        $bookingsize = Booking::SpaceCalculator($request->size);

        foreach ($request->edition as $edition_id) {
            $size = 0;
            $edition = Edition::where('id', $edition_id)->first();
            $bookings = $edition->bookings()->get();
            if (count($bookings) == 0) {
                continue;
            }
            foreach ($bookings as $booking) {
                $size += Booking::SpaceCalculator($booking->size);
                if ($booking->email == $request->email) {
                    $found = $edition;
                } else if (($size + $bookingsize) > $edition->space) {
                    $fullEdition = $edition;
                }
            }
        }


        if ($found != null) {
            return back()->with('error', 'U heeft al een reservering geplaats in de ' . $found->title . ' editie')->withInput();
        } else if ($fullEdition != null) {
            return back()->with('error', 'U heeft een reservering geplaats in de ' . $found->title . ' editie die helaas vol zit')->withInput();
        }
        return null;
    }

    public static function generateBooking(Request $request, $acceptedReservation)
    {
        $validation =  $request->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'size' => ['required'],
            'type' => ['required'],
            'edition' => ['required', 'array', 'min:1'],
            'email' => ['required', 'email', 'min:3', 'max:255'],
        ]);

        $validationBooking =  BookingController::validationForBooking($request);
        if ($validationBooking !== null) {
            return $validationBooking;
        }

        $user = User::where('email', $validation['email'])->first();
        if ($user == null) {
            $user = new User();
            $user->email = $validation['email'];
            $user->password = Hash::make('Test123?');
            $user->save();
        }

        if (!$acceptedReservation) {
            $url = URL::temporarySignedRoute('bookingsuccess', now()->addYear(2), [
                'user' => $user->id,
                'email' => $validation['email'],
                'size' => $validation['size'],
                'type' => $validation['type'],
                'title' => $validation['title'],
                'edition' => urlencode(serialize($validation['edition'])),
            ]);
            SendEmailJob::dispatch($user->email, new BookingCreation($url, $user));
        } else {
            $request->edition = serialize($validation['edition']);
            $request->user = $user->id;
            return BookingController::createBookingDB($request);
        }
    }

    public static function createBookingDB(Request $request)
    {
        $editions = unserialize(urldecode($request->edition));
        $request->edition = $editions;
        $validation = BookingController::validationForBooking($request);
        if ($validation !== null) {
            return null;
        }
        $booking = new Booking();
        $booking->size = $request->size;
        $booking->type = $request->type;
        $booking->email = $request->email;
        $booking->title = $request->title;
        $booking->user_id = $request->user;
        $booking->save();
        foreach ($editions  as $edition) {
            $editionDB = Edition::find($edition);
            $editionDB->bookings()->attach($booking);
        }
        SendEmailJob::dispatch('knstadskrant@gmail.com', new NewReservationNotification($booking->id));
        return $booking;
    }

    public function checkTokenBooking(Request $request)
    {
        if ($request->hasValidSignature()) {
            $booking = BookingController::createBookingDB($request);
            if ($booking === null) {
                $title = 'Duplicatie';
                $text = 'Beste klant u hebt deze link al eerder gebruikt om een reservering the bevestigen';
                return view('/pages/successAction', ['title' => $title, 'text' => $text]);
            }
            $user = User::find($request->user);
            $title = 'BEDANKT VOOR UW RESERVATIE!';
            $text = 'Beste klant uw reservering is geplaatst en ontvangt zo spoedig mogelijk een confirmatie link voor uw reservering';
            // create the link for publication
            $url = URL::temporarySignedRoute('publicationSigned', now()->addMonths(1.5), [
                'user_id' => $user->id,
                'booking_id' => $booking->id
            ]);
            SendEmailJob::dispatch($user->email, new PublicationUploadLink($url, $user));
            return view('/pages/successAction', ['title' => $title, 'text' => $text]);
        } else {
            $title = 'DE LINK IS VERLOPEN';
            $text = 'Beste klant de verificatie link is verlopen. Vul het formulier opnieuw in om een nieuwe link te ontvangen om het process te herstarten';
            return view('/pages/successAction', ['title' => $title, 'text' => $text]);
        }
    }

    public function successBooking()
    {
        $title = 'BEDANKT VOOR UW RESERVATIE!';
        $text = 'U zult binnen enkele minuten een mail ontvangen met de link om uw publicatie op een later tijdstip te uploaden';
        return view('/pages/successAction', ['title' => $title, 'text' => $text]);
    }
}
