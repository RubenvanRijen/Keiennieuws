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


        return view('pages.dashboard.admin.designs.homepage.homePageEditing', ['simpleArticles' => $simpleArticles, 'simpleStatements' => $simpleStatements]);
    }
}
