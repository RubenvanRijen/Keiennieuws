<?php

namespace App\Http\Controllers;

use App\Enums\HomePageCmsEnum;
use App\Enums\HomePageTypeCmsEnum;
use App\Models\SimpleHtmlCms;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class DesignController extends Controller
{

    public function index()
    {
        return view('pages.dashboard.admin.designs.indexDesigns');
    }

    public function indexHomePageEdit()
    {
        $simpleArticles = SimpleHtmlCms::where('page', HomePageCmsEnum::homePage)->where('type', HomePageTypeCmsEnum::acticles)->get();
        $simpleStatements = SimpleHtmlCms::where('page', HomePageCmsEnum::homePage)->where('type', HomePageTypeCmsEnum::statement)->get();
        $simpleVolunteers = SimpleHtmlCms::where('page', HomePageCmsEnum::homePage)->where('type', HomePageTypeCmsEnum::volunteers)->get();
        $simpleprices = SimpleHtmlCms::where('page', HomePageCmsEnum::informationPage)->where('type', HomePageTypeCmsEnum::prices)->get();


        return view('pages.dashboard.admin.designs.homepage.homePageEditing', ['simpleArticles' => $simpleArticles, 'simpleStatements' => $simpleStatements, 'simpleVolunteers' => $simpleVolunteers, 'simplePrices' => $simpleprices]);
    }

    public function changePictureOneHomePage(Request $request)
    {
        $file = null;
        if ($request->hasFile('file')) {
            $file = $request->file;
            $file->originalName = 'homepageOne.jpeg';
            $file->basename = 'homepageOne.jpeg';
            $link = $file->storeAs('/public/homepageContent', 'homepageOne.jpeg');
        }
        ///dashboard/admin/design-edit/home-page/image-edit-one
        return back()->with('success', 'u heeft success de afbeelding aangepast. Check of de nieuwe afbeelding wel past');
    }

    public function changePictureTwoHomePage(Request $request)
    {

        $file = null;
        if ($request->hasFile('file')) {
            $file = $request->file;
            $file->originalName = 'sectionFive.jpeg';
            $file->basename = 'sectionFive.jpeg';
            $link = $file->storeAs('/public/homepageContent', 'sectionFive.jpeg');
        }

        ///storage/homepageContent/sectionFive.jpeg
        return back()->with('success', 'u heeft success de afbeelding aangepast. Check of de nieuwe afbeelding wel past');
    }
}
