<?php

namespace App\Http\Controllers;

use App\Mail\VolunteerApplication;
use App\Models\Edition;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        $date = Carbon::now();
        $futureDate = Carbon::now()->addMonth();
        $editions =  Edition::whereBetween('endDateUpload',  [$date, $futureDate])->get();
        $dates = [];
        $diff = 0;
        foreach ($editions as $edition) {
            $dates[$edition->id] = $edition->beginDateUpload;
        }
        $nearestDate = min($dates);
        $editionId = array_search($nearestDate, $dates);
        $edition = Edition::where('id', $editionId)->first();

        //calculate diff in days
        $earlier = new DateTime(date('Y-m-d'));
        $later = new DateTime($edition->endDateUpload);
        $diff = $later->diff($earlier)->format("%a");

        return view('/pages/home', ['timeDiff' => $diff,]);
    }

    public function informationIndex()
    {
        return view('/pages/information');
    }

    public function volunteerApplication(Request $request)
    {
        $title = 'BEDANKT VOOR UW AANMELDING!';
        $text = 'U zult zo spoedig mogelijk een antwoord krijgen';
        if ($request->botTest) {
            return view('/pages/successAction', ['title' => $title, 'text' => $text]);
        }

        $validation =  $request->validate([
            'email' => ['required', 'email', 'min:3', 'max:255'],
            'name' => ['required',  'min:3', 'max:255'],
            'explenation' => ['required', 'min:3', 'max:400'],
        ]);

        Mail::to($validation['email'])->send(new VolunteerApplication($validation['name'], $validation['email'], $validation['explenation']));
        return view('/pages/successAction', ['title' => $title, 'text' => $text]);
    }
}
