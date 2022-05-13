<?php

namespace App\Http\Controllers;

use App\Mail\BookingCreation;
use App\Models\Booking;
use App\Models\Edition;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
        $validation =  $request->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'size' => ['required'],
            'type' => ['required'],
            'edition' => ['required', 'array', 'min:1'],
            'email' => ['required', 'email', 'min:3', 'max:255'],
        ]);
        $found = null;
        $fullEdition = null;
        $bookingsize = Booking::SpaceCalculator($validation['size']);

        foreach ($validation['edition'] as $edition_id) {
            $size = 0;
            $edition = Edition::where('id', $edition_id)->first();
            $bookings = $edition->bookings()->get();
            if (count($bookings) == 0) {
                continue;
            }
            foreach ($bookings as $booking) {
                $size += Booking::SpaceCalculator($booking->size);
                if ($booking->email == $validation['email']) {
                    $found = $edition;
                } else if (($size + $bookingsize) > $edition->space) {
                    $fullEdition = $edition;
                }
            }
        }

        if ($found != null) {
            return back()->with('error', 'U heeft al een reservering geplaats in de ' . $found->title . ' editie')->withInput();
        } else if ($fullEdition != null) {
            return back()->with('error', 'U heeft al een reservering geplaats in de ' . $found->title . ' editie die helaas vol zit')->withInput();
        }

        $user = User::where('email', $validation['email'])->first();
        if ($user == null) {
            $user = new User();
            $user->email = $validation['email'];
            $user->password = Hash::make('Test123?');
            $user->save();
        }
        $url = URL::temporarySignedRoute('bookingsuccess', now()->addYear(2), [
            'user' => $user->id,
            'email' => $validation['email'],
            'size' => $validation['size'],
            'type' => $validation['type'],
            'title' => $validation['title'],
            'editions' => urlencode(serialize($validation['edition'])),
        ]);
        Mail::to($user->email)->send(new BookingCreation($url, $user));
        return redirect('/successactionbooking');
    }

    public function checkTokenBooking(Request $request)
    {
        if ($request->hasValidSignature()) {
            $editions = unserialize(urldecode($request->editions));
            $booking = new Booking();
            $booking->size = $request->size;
            $booking->type = $request->type;
            $booking->email = $request->email;
            $booking->title = $request->title;
            $booking->save();
            foreach ($editions  as $edition) {
                $editionDB = Edition::find($edition);
                $editionDB->bookings()->attach($booking);
            }
            $title = 'BEDANKT VOOR UW RESERVATIE!';
            $text = 'Beste klant uw reservering is geplaatst en ontvangt zo spoedig mogelijk een link voor de publicatie';
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
        $text = 'U zult binnen enkele minuten een bevestigingsmail ontvangen met de link om uw publicatie op een later tijdstip te uploaden';
        return view('/pages/successAction', ['title' => $title, 'text' => $text]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
