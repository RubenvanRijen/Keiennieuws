<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
