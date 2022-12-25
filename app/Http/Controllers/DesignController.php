<?php

namespace App\Http\Controllers;

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
        return view('pages.dashboard.admin.designs.HomePageEditing');
    }
}
