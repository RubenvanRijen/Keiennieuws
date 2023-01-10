<?php

namespace App\Http\Controllers;

use App\Models\SimpleHtmlCms;
use Faker\Core\Number;
use Illuminate\Http\Request;

class SimpleHtmlCmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SimpleHtmlCms  $simpleHtmlCms
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $simpleHtml = SimpleHtmlCms::find($id);

        return view('pages.dashboard.admin.designs.homepage.homepageSimpleHtmlIndex', ['simpleHtml' => $simpleHtml]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SimpleHtmlCms  $simpleHtmlCms
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $simpleHtml = SimpleHtmlCms::find($id);

        return view('pages.dashboard.admin.designs.homepage.homepageSimpleHtmlEdit', ['simpleHtml' => $simpleHtml]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SimpleHtmlCms  $simpleHtmlCms
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $simpleHtml = SimpleHtmlCms::find($id);

        $simpleHtmlInformation = $request->information;

        $simpleHtmlInformation = trim($simpleHtmlInformation);
        $simpleHtmlInformation = stripslashes($simpleHtmlInformation);
        $simpleHtmlInformation = htmlspecialchars($simpleHtmlInformation);

        $request->information = $simpleHtmlInformation;

        $simpleHtml->fill($request->input());
        $simpleHtml->save();

        return back()->with('success', 'De gegevens zijn correct aanegepast');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SimpleHtmlCms  $simpleHtmlCms
     * @return \Illuminate\Http\Response
     */
    public function destroy(SimpleHtmlCms $simpleHtmlCms)
    {
        //
    }
}
