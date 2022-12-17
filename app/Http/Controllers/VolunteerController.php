<?php

namespace App\Http\Controllers;

use App\Models\File;
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
        $volunteers = Volunteer::orderBy('name', 'asc')->simplePaginate(15);
        $volunteerImages = [];
        foreach ($volunteers as $volunteer) {
            array_push($volunteerImages, Storage::url($volunteer->path));
        }
        return view('pages.dashboard.admin.designs.volunteers.indexVolunteers', ['volunteers' => $volunteers, 'volunteerImages' => $volunteerImages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.dashboard.admin.designs.volunteers.createVolunteer');
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
        //save file
        $link = null;
        if ($request->hasFile('file')) {
            $link = $valid['file']->store('/public/volunteers');
        }

        $volunteer = new Volunteer();
        $volunteer->name = $valid['name'];
        $volunteer->email = $valid['email'];
        $volunteer->phoneNumber = $valid['phoneNumber'];
        $volunteer->top = $valid['top'];
        $volunteer->information = $valid['information'];
        $volunteer->path = $link;
        $volunteer->save();
        return back()->with('success', "De vrijwiliger is succesvol aangemaakt");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Volunteer  $volunteer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id === null) {
            return redirect('/cms/volunteers')->with('error', "Oeps er ging iets miss");
        }
        $volunteer = Volunteer::find($id);
        $image = Storage::url($volunteer->path);
        return view('pages.dashboard.admin.designs.volunteers.indexVolunteer', ['volunteer' => $volunteer, 'image' => $image]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Volunteer  $volunteer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($id === null) {
            return redirect('/cms/volunteers')->with('error', "Oeps er ging iets miss");
        }
        $volunteer = Volunteer::find($id);
        $image = Storage::url($volunteer->path);
        return view('pages.dashboard.admin.designs.volunteers.editVolunteer', ['volunteer' => $volunteer, 'image' => $image]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Volunteer  $volunteer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($id === null) {
            return redirect('/cms/volunteers')->with('error', "Oeps er ging iets miss");
        }
        $volunteer = Volunteer::find($id);

        $valid = $request->validate([
            'name' => 'required|string|unique:volunteers,name,' . $volunteer->id,
            'email' => 'email|required',
            'phoneNumber' => 'required',
            'file' => 'max:4096',
            'top' => 'required|boolean',
            'information' => 'required|max:300'
        ]);

        if ($request->hasFile('file')) {
            Storage::disk('local')->delete($volunteer->path);
        }

        $volunteer->name = $valid['name'];
        $volunteer->email = $valid['email'];
        $volunteer->phoneNumber = $valid['phoneNumber'];
        $volunteer->top = $valid['top'];
        $volunteer->information = $valid['information'];
        $volunteer->save();

        if ($request->hasFile('file')) {
            $link = $valid['file']->store('/public/volunteers');
            $volunteer->path = $link;
        }

        $volunteer->save();
        return back()->with('success', "De wijziging was successvol");
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
        if ($volunteer->path !== null) {
            Storage::disk('local')->delete($volunteer->path);
        }
        $message = "U heeft succesvol de vrijwiliger $volunteer->name verwijdert";
        $volunteer->delete();
        return back()->with('success', $message);
    }
}
