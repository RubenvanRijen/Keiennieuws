<?php

namespace App\Http\Controllers;

use App\Enums\HomePageCmsEnum;
use App\Enums\HomePageTypeCmsEnum;
use App\Jobs\DeleteFiles;
use App\Jobs\SendEmailJob;
use App\Mail\Uploadpicture;
use App\Mail\VolunteerApplication;
use App\Models\Edition;
use App\Models\SimpleHtmlCms;
use App\Models\Volunteer;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;


class HomeController extends Controller
{
    public function index()
    {

        $date = Carbon::now();
        $futureDate = Carbon::now()->addMonth();
        $editions =  Edition::whereBetween('endDateUpload',  [$date, $futureDate])->get();
        $dates = [];
        $diff = 0;
        $edition = null;
        if (count($editions) > 0) {
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
        }

        $volunteers = Volunteer::where('top', '1')->get();
        $volunteerImages = [];
        foreach ($volunteers as $volunteer) {
            array_push($volunteerImages, Storage::url($volunteer->path));
        }
        $simpleArticles = SimpleHtmlCms::where('page', HomePageCmsEnum::homePage)->where('type', HomePageTypeCmsEnum::acticles)->get();
        $simpleStatements = SimpleHtmlCms::where('page', HomePageCmsEnum::homePage)->where('type', HomePageTypeCmsEnum::statement)->get();
        $simpleVolunteers = SimpleHtmlCms::where('page', HomePageCmsEnum::homePage)->where('type', HomePageTypeCmsEnum::volunteers)->get();
        return view('/pages/home', ['timeDiff' => $diff, 'edition' => $edition, 'volunteers' => $volunteers, 'volunteerImages' => $volunteerImages, 'simpleArticles' => $simpleArticles, 'simpleStatements' => $simpleStatements, 'simpleVolunteers' => $simpleVolunteers]);
    }

    public function informationIndex()
    {
        $simpleprices = SimpleHtmlCms::where('page', HomePageCmsEnum::informationPage)->where('type', HomePageTypeCmsEnum::prices)->get();

        return view('/pages/information', ['simpleprices' => $simpleprices]);
    }

    public function volunteerApplication(Request $request)
    {
        $title = 'BEDANKT VOOR UW AANMELDING!';
        $text = 'U zult zo spoedig mogelijk een antwoord krijgen';
        if ($request->botTest) {
            return view('/pages/successAction', ['title' => $title, 'text' => $text]);
        }

        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'min:3', 'max:255'],
            'nameVolunteer' => ['required',  'min:3', 'max:255'],
            'explenation' => ['required', 'min:3', 'max:400'],
        ]);

        if ($validator->fails()) {
            return redirect()->to('/home#volunteerapplication')->withErrors($validator)->withInput();
        }

        $validation = $validator->validated();

        sendEmailJob::dispatch('knstadskrant@gmail.com', new VolunteerApplication($validation['nameVolunteer'], $validation['email'], $validation['explenation']));
        return view('/pages/successAction', ['title' => $title, 'text' => $text]);
    }

    public function photoUpload(Request $request)
    {
        $title = "BEDANKT VOOR UW FOTO'S/BESTANDEN!";
        $text = "We zullen er goed gebruik van maken";
        if ($request->botTest) {
            return view('/pages/successAction', ['title' => $title, 'text' => $text]);
        }

        $validator = Validator::make($request->all(), [
            'file' => ['required', 'array', 'between:1,5'],
            'file.*' => ['max:5048'],
            'showName' => ['required'],
            'name' => ['required_if:showName,==,1', 'max:255'],
        ], [
            'showName.required' => 'U moet een optie kiezen'
        ]);

        if ($validator->fails()) {
            return redirect()->to('/home#uploadpicture')->withErrors($validator)->withInput();
        }
        // check if the name is not to short
        // this could not be put in the same validation as previous because of the showName boolean
        $validator2 = null;
        if ($request->input('showName') === "1") {
            $validator2 = Validator::make($request->all(), ['name' => ['min:3']]);
            if ($validator2->fails()) {
                return redirect()->to('/home#uploadpicture')->withErrors($validator2)->withInput();
            }
        }

        $validation = $validator->validated();
        $files = [];

        if ($request->hasFile('file')) {
            foreach ($request->file as $file) {
                $fileName = date("Y-m-d H:i:s") . '-' . $file->getClientOriginalName();
                $fileData = $file->store('/public/temp');
                array_push($files, $fileData);
            }
        }
        Bus::chain([
            new sendEmailJob('knstadskrant@gmail.com', new Uploadpicture($validation['name'], $files)),
            new DeleteFiles($files)
        ])->dispatch();



        return view('/pages/successAction', ['title' => $title, 'text' => $text]);
    }
}
