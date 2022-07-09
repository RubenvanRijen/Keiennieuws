<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Edition;
use App\Models\Publication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date = date("Y/m/d");
        $editions = Edition::whereDate('endDateUpload', '>=', $date)->orderBy('endDateUpload', 'asc')->paginate(12);
        $user = Auth::user();

        $types = Publication::getEnumType();
        $sizes = Publication::getEnumSize();

        return view('/pages/placePublication', ['user' => $user, 'editions' => $editions, 'sizes' => $sizes, 'types' => $types,]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSigned(Request $request)
    {
        if (Auth::user() && Auth::user()->id !== $request->user_id) {
            abort(404);
        }
        $date = date("Y/m/d");
        $editions = Edition::whereDate('endDateUpload', '>=', $date)->orderBy('endDateUpload', 'asc')->paginate(12);
        $user = User::find($request->user_id);
        $booking = Booking::find($request->booking_id);

        $types = Publication::getEnumType();
        $sizes = Publication::getEnumSize();

        return view('/pages/placePublication', ['user' => $user, 'booking' => $booking, 'editions' => $editions, 'sizes' => $sizes, 'types' => $types,]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation =  $request->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'size' => ['required'],
            'type' => ['required'],
            'edition' => ['required', 'array', 'min:1'],
            'email' => ['required', 'email', 'min:3', 'max:255'],
            'file' => ['required', 'array', 'between:1,5'],
            'file.*' => ['max:5048'],
            'placedBooking' => 'required',
            'placeBooking' => 'required_if:placedBooking,1|',
        ]);

        //TODO code voor opslaan
        return redirect('/successactionpublication');
    }

    public function successPublication()
    {
        return view('/pages/successAction', ['title' => 'UW PUBLICATIE IS GEUPLOAD!', 'text' => 'Uw bestand word zo spoedig mogelijk verwerkt']);
    }
}
