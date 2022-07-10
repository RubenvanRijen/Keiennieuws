<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Mail\PublicationCofirmation;
use App\Models\Booking;
use App\Models\Edition;
use App\Models\File;
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
        $booking = new Booking();
        $booking->id = null;

        $types = Publication::getEnumType();
        $sizes = Publication::getEnumSize();
        $booking_editions = [];
        return view('/pages/placePublication', ['user' => $user, 'editions' => $editions, 'sizes' => $sizes, 'types' => $types, 'booking' => $booking, 'booking_editions' => $booking_editions,]);
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


        $booking_editions = $booking->editions->pluck('id');

        $types = Publication::getEnumType();
        $sizes = Publication::getEnumSize();

        return view('/pages/placePublication', ['user' => $user, 'booking' => $booking, 'editions' => $editions, 'sizes' => $sizes, 'types' => $types, 'booking_editions' => $booking_editions,]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->botTest) {
            return view('/pages/successAction', ['title' => 'UW PUBLICATIE IS GEUPLOAD!', 'text' => 'Uw bestand word zo spoedig mogelijk verwerkt']);
        }

        $rules = [
            'file' => ['required', 'array', 'between:1,5'],
            'file.*' => ['max:5048'],
            'title' => ['required', 'min:3', 'max:255'],
            'type' => ['required'],
            'edition' => ['required', 'array', 'min:1'],
            'email' => ['required', 'email', 'min:3', 'max:255'],
            'information' => ['max:20000'],
            'placedBooking' => 'required',
            'size' => ['required_if:placedBooking,1'],
            'placeBooking' => ['required_if:placedBooking,1'],
        ];

        $customMessages = [
            'placeBooking.required_if' => 'U moet kiezen of u wel of geen reservering wilt plaatsen',
            'placedBooking.required' => 'U moet kiezen of u wel of geen reservering heeft geplaatsen'
        ];

        $validation = $this->validate($request, $rules, $customMessages);


        $booking = null;
        if ($request->booking_id == null && $request->placedBooking == 1 && $request->placeBooking == 0) {
            $booking  = BookingController::generateBooking($request, true);
        }

        $publication = new Publication();
        $publication->title = strtolower($validation['title']);
        $publication->email = $validation['email'];
        $publication->information = $validation['information'];
        $publication->type = $validation['type'];
        $publication->size = $validation['size'];
        if ($request->booking_id !== null) {
            $publication->booking_id = $request->booking_id;
        } else if ($booking !== null) {
            $publication->booking_id = $booking->id;
        } else {
            $publication->booking_id = null;
        }
        $publication->save();

        if ($request->hasFile('file')) {
            foreach ($request->file as $file) {
                $fileName = date("Y-m-d H:i:s") . '-' . $file->getClientOriginalName();
                $link = $file->store('/public');
                $fileData = new File();
                $fileData->title = $fileName;
                $fileData->publication_id = $publication->id;
                $fileData->location = $link;
                $fileData->originalTitle = $file->getClientOriginalName();
                $fileData->author = $publication->email;
                $fileData->save();
            }
        }

        $text = '';
        if ($request->placeBooking == 0) {
            $text = 'Uw publicatie en reservering is correct en in goed handen ontvangen';
        } else {
            $text = 'Uw publicatie is correct en in goed handen ontvangen';
        }
        SendEmailJob::dispatch($publication->email, new PublicationCofirmation($text));
        return redirect('/successactionpublication');
    }

    public function successPublication()
    {
        return view('/pages/successAction', ['title' => 'UW PUBLICATIE IS GEUPLOAD!', 'text' => 'Uw bestand word zo spoedig mogelijk verwerkt']);
    }
}
