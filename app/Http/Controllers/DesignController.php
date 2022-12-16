<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DesignController extends Controller
{

    public function index()
    {
        return view('pages.dashboard.admin.designs.indexDesigns');
    }
}
