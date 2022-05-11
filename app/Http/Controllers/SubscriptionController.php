<?php

namespace App\Http\Controllers;

use App\Mail\StartSubscription;
use App\Models\Subscription;
use App\Models\Token;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class SubscriptionController extends Controller
{



    public function checkToken(Request $request)
    {
        $subscription = Subscription::find($request->subscription);
        if ($request->hasValidSignature()) {
            $subscription->endDate = Carbon::createFromDate(2900, 01, 01)->format('Y-m-d H:i:s');
            $subscription->save();
            $title = 'VOLTOOID!';
            $text = 'Uw abonnement is geverifieerd en voltooid';
            return view('/pages/subscription/endingSubscription', ['title' => $title, 'text' => $text]);
        } else {
            $title = 'DE LINK IS VERLOPEN';
            $text = 'Beste klant de verificatie link is verlopen. Vul het formulier opnieuw in om een nieuwe link te ontvangen en uw account te verrifiëren';
            return view('/pages/subscription/endingSubscription', ['title' => $title, 'text' => $text]);
        }
    }
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
        $user = Auth::user();
        return view('/pages/subscription/start/stepTwoStartSubscription', ['user' => $user]);
    }

    public function startStepTwoForm(Request $request)
    {
        $customer = User::where('email', $request->input('email'))->first();
        $nowDate = Carbon::now();
        if ($customer !== null && $customer->subscription()->first() !== null && $customer->subscription()->first()->endDate !== null && !$nowDate->gt($customer->subscription()->first()->endDate)) {
            return back()->with('error', 'U heeft al een abonnement op het Keiennieuws')->withInput();
        } else if ($customer !== null && $customer->subscription()->first() !== null && $customer->subscription()->first()->endDate === null && Carbon::parse($customer->subscription()->first()->validTill)->isPast()) {
            $url = URL::temporarySignedRoute('subscribe', now()->addDays(1), ['user' => $customer->id, 'subscription' => $customer->subscription()->first()->id]);
            $subscription = Subscription::find($customer->subscription()->first()->id);
            $subscription->validTill = now()->addDays(1);
            $subscription->save();
            Mail::to($customer->email)->send(new StartSubscription($url, $customer));
            return redirect('/subscription/startfinal');
        }

        $validation =  $request->validate([
            'firstname' => ['required', 'string', 'max:255', 'min:3'],
            'lastname' => ['required', 'string', 'max:255', 'min:3'],
            'gender' => ['required'],
            'postcode' => 'required|postal_code:NL,DE,FR,BE',
            'house_number' => 'required|regex:/[0-9][a-z]?/',
            'city' => ['required', 'string', 'max:255'],
            'email' =>  ['required', 'string', 'email', 'max:255'],
            'street_name' => ['required', 'string', 'max:255', 'min:3'],
        ]);

        $userData = User::where('email', $validation['email'])->first();
        $data = [];
        if ($userData === null && !(Auth::attempt(['email' => $validation['email'], 'password' => 'Test123?']))) {
            $request->session()->regenerate();
            $data = ['password' => Hash::make('Test123?')];
        }
        $user = User::updateOrCreate(
            ['email' => $request->email],
            $data
        );
        $user->fill($validation)->save();
        $subscription =  new Subscription();
        $subscription->validTill = now()->addDay(1);
        $subscription->user()->associate($user);
        $subscription->save();
        $url = URL::temporarySignedRoute('subscribe', now()->addDays(1), ['user' => $user->id, 'subscription' => $subscription->id]);
        Mail::to($user->email)->send(new StartSubscription($url, $user));
        return redirect('/subscription/startfinal');
    }

    public function startFinal()
    {
        $title = 'VOLTOOID!';
        $text = 'Binnen nu en 1 dag ontvangt u een bevestigingsemail.
            het redactie team wenst u veel lees plezier.';
        return view('/pages/subscription/endingSubscription', ['title' => $title, 'text' => $text]);
    }


    public function endStepOne()
    {
        return view('/pages/subscription/end/stepOneEndSubscription');
    }

    public function endStepTwo()
    {
        $user = Auth::user();
        return view('/pages/subscription/end/stepTwoEndSubscription', ['user' => $user]);
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

    public function editAdress()
    {
        return view('/pages/subscription/edit/stepTwoEditAdressSubscription');
    }

    public function editAdressForm(Request $request)
    {
        //TODO doe iets met het form
        return redirect('/subscription/editFinalAdress');
    }

    public function editEmail()
    {
        return view('/pages/subscription/edit/stepTwoEditEmailSubscription');
    }

    public function editEmailForm(Request $request)
    {
        //TODO doe iets met het form
        return redirect('/subscription/editFinalEmail');
    }

    public function editFinalEmail()
    {
        $title = 'UW EMAILADRES IS GEWIJZIGD';
        $text = 'U ontvangt binnen enkele minute een automatische email die naar uw nieuwe emailadres wordt gestuurd.
        Dit wordt gedaan om te controleren of de wijzigingen goed gelukt zijn.';
        return view('/pages/subscription/endingSubscription', ['title' => $title, 'text' => $text]);
    }

    public function editFinalAdress()
    {
        $title = 'UW BEZORGADRES IS GEWIJZIGD.';
        $text = 'U ontvangt binnen enkele dagen een bevestigingsmail van uw wijziging.';
        return view('/pages/subscription/endingSubscription', ['title' => $title, 'text' => $text]);
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
