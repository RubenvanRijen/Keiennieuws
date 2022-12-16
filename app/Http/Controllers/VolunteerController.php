<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VolunteerController extends Controller
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
        $valid = $request->validate([
            'name' => 'required|string|unique:volunteers',
            'email' => 'email|required',
            'phoneNumber' => 'required',
            'file' => 'required|max:4096',
            'top' => 'required|boolean',
            'information' => 'required|max:300'
        ]);
        $link = $valid['file']->store('/public');
        $urlLocal = Storage::url($link);
        $volunteer = new Volunteer();
        $volunteer->name = $valid['name'];
        $volunteer->email = $valid['email'];
        $volunteer->phoneNumber = $valid['phoneNumber'];
        $volunteer->top = $valid['top'];
        $volunteer->information = $valid['information'];
        $volunteer->path = $link;
        $volunteer->localUrl = $urlLocal;
        $volunteer->save();
        return redirect("/cms/volunteers/create")->with('success', "De vrijwiliger is succesvol aangemaakt");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Volunteer  $volunteer
     * @return \Illuminate\Http\Response
     */
    public function show(Volunteer $volunteer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Volunteer  $volunteer
     * @return \Illuminate\Http\Response
     */
    public function edit(Volunteer $volunteer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Volunteer  $volunteer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Volunteer $volunteer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Volunteer  $volunteer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id === null) {
            return back()->with('error', "Oeps er ging iets fout");
        }
        $volunteer = Volunteer::find($id);
        Storage::disk('local')->delete($volunteer->path);
        $message = "U heeft succesvol de vrijwiliger $volunteer->name verwijdert";
        $volunteer->delete();
        return back()->with('success', $message);
    }
}
