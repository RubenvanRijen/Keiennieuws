<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        // dd($allowedBookings);

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
}
