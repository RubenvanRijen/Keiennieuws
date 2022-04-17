<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use PDO;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/pages/subscription/homeSubscription');
    }

    public function startStepOne()
    {
        return view('/pages/subscription/start/stepOneStartSubscription');
    }

    public function startStepTwo()
    {
        return view('/pages/subscription/start/stepTwoStartSubscription');
    }

    public function startStepTwoForm(Request $request)
    {
        //TODO doe iets met het form
        return redirect('/subscription/startfinal');
    }

    public function startFinal()
    {
        $title = 'VOLTOOID!';
        $text = 'Binnen nu en 7 dagen ontvangt u een bevestigingsemail.
            het redactie team wenst u veel lees plezier.';
        return view('/pages/subscription/endingSubscription', ['title' => $title, 'text' => $text]);
    }


    public function endStepOne()
    {
        return view('/pages/subscription/end/stepOneEndSubscription');
    }

    public function endStepTwo()
    {
        return view('/pages/subscription/end/stepTwoEndSubscription');
    }

    public function endStepTwoForm(Request $request)
    { //TODO doe iets met het form
        return redirect('/subscription/endfinal');
    }

    public function endFinal()
    {
        $title = 'UW VERZOEK OM UW ABONNEMENT TE BEËINDIGEN IS VERSTUURD.';
        $text = 'Binnen nu en 7 dagen ontvangt u een bevestigingsemail.';
        return view('/pages/subscription/endingSubscription', ['title' => $title, 'text' => $text]);
    }

    public function editStepOne()
    {
        return view('/pages/subscription/edit/stepOneEditSubscription');
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
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        //
    }
}
