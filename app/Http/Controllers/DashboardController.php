<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Undefined;

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
        if ($user instanceof User) {
            $bookings = $user->bookings()->get();
        }
        return view('/pages/dashboard', ['user' => $user,  'bookings' => $bookings]);
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
