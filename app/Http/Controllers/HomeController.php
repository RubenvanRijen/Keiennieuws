<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

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
}
