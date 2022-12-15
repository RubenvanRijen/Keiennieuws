<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Mail\NewPublicationNotification;
use App\Mail\PublicationCofirmation;
use App\Models\Booking;
use App\Models\Edition;
use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;

class PublicationController extends Controller
{

    /**
     * this controller is made to create a reservation and upload the
     * files at the same time but also use a signed url to upload the files later to a booking
     */

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

        $types = Booking::getEnumType();
        $sizes = Booking::getEnumSize();
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

        $types = Booking::getEnumType();
        $sizes = Booking::getEnumSize();

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

        //bot test
        if ($request->botTest) {
            return view('/pages/successAction', ['title' => 'UW PUBLICATIE IS GEUPLOAD!', 'text' => 'Uw bestand word zo spoedig mogelijk verwerkt']);
        }


        // make shure a person doesn't upload more then 10 files when using the link mulitple times
        if ($request->booking_id != null) {
            $bok = Booking::find($request->booking_id);
            $amount = count($bok->files()->get());
            if ($amount > 10) {
                return redirect()->back()->with('error', 'U heeft al 10 bestanden geupload');
            }
        }


        $rules = [
            'file' => ['required', 'array', 'between:1,5'],
            'file.*' => ['max:5048'],
            'title' => ['required', 'min:3', 'max:255'],
            'type' => ['required'],
            'edition' => ['required', 'array', 'min:1'],
            'email' => ['required', 'email', 'min:3', 'max:255'],
            'information' => ['max:20000'],
            'size' => ['required'],
            'checkPayment' => ['required']
        ];

        $customMessages = [
            'information.max:20000' => 'U mag maximaal 5000 tekens gebruiken',
            'title.min:3' => 'Uw titel moet minstens uit 3 tekens bestaand',
            'checkPayment.required' => 'U moet deze checkbox aantikken als u het eens bent met de voorwaarden'
        ];
        $sameEditions = true;
        if ($request->booking_id) {
            $bookingData = Booking::find($request->booking_id);
            $oldEditions = $bookingData->editions()->get();

            $editionsSelected = $request->edition;
            if (count($editionsSelected) != count($oldEditions)) {
                $sameEditions = false;
            }
            if ($sameEditions == true) {
                for ($i = 0; $i < count($editionsSelected); $i++) {
                    $sameEditions = in_array($oldEditions[$i]->id, $editionsSelected);
                    if ($sameEditions == false) {
                        break;
                    }
                }
            }
        }

        if ($sameEditions == false) {
            return back()->with('error', 'U heeft de gekozen edities aangepast')->withInput();
        }

        $validation = $this->validate($request, $rules, $customMessages);

        $booking = null;
        if ($request->booking_id == null) {
            $booking  = BookingController::generateBooking($request, true);
        } else {
            $booking = Booking::find($request->booking_id);
        }

        //set then information for a booking
        $booking->information = $request->information;
        $booking->save();

        if (!$booking instanceof Booking && $request->booking_id == null) {
            return $booking;
        }

        if ($request->hasFile('file')) {
            foreach ($request->file as $file) {
                $fileName = date("Y-m-d H:i:s") . '-' . $file->getClientOriginalName();
                $link = $file->store('/public');
                $fileData = new File();
                $fileData->title = $fileName;
                $fileData->booking_id = $booking->id;
                $fileData->location = $link;
                $fileData->originalTitle = $file->getClientOriginalName();
                $fileData->author = $booking->email;
                $fileData->save();
            }
        }

        $text = '';
        if ($request->placeBooking == 0) {
            $text = 'Uw publicatie en reservering zijn correct en in goed handen ontvangen';
        } else {
            $text = 'Uw publicatie is correct en in goed handen ontvangen';
        }
        Bus::chain([
            new SendEmailJob($booking->email, new PublicationCofirmation($text)),
            new SendEmailJob('knstadskrant@gmail.com', new NewPublicationNotification($booking->id)),
        ])->dispatch();

        return redirect('/successactionpublication');
    }

    public function successPublication()
    {
        return view('/pages/successAction', ['title' => 'UW PUBLICATIE IS GEUPLOAD!', 'text' => 'Uw bestand word zo spoedig mogelijk verwerkt']);
    }
}
