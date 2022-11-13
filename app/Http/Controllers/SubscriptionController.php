<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Mail\EditEmail;
use App\Mail\EditResidence;
use App\Mail\EndSubscription;
use App\Mail\EndSubscriptionNotification;
use App\Mail\StartSubscription;
use App\Mail\StartSubscriptionNotification;
use App\Mail\UserEditNotification;
use App\Models\Subscription;
use App\Models\Token;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class SubscriptionController extends Controller
{

    public function standartResponse()
    {
        $title = 'DE LINK IS VERLOPEN';
        $text = 'Beste klant de verificatie link is verlopen. Vul het formulier opnieuw in om een nieuwe link te ontvangen om het process te herstarten';
        return view('/pages/subscription/endingSubscription', ['title' => $title, 'text' => $text]);
    }


    public function checkTokenStart(Request $request)
    {
        if ($request->hasValidSignature()) {
            $user = User::find($request->user);
            $title = 'VOLTOOID!';
            $text = 'Uw abonnement is geverifieerd en voltooid';
            if ($user->subscription()->first() === null) {
                $subscription =  new Subscription();
                $subscription->user()->associate($user);
                $subscription->save();
            }
            return view('/pages/subscription/endingSubscription', ['title' => $title, 'text' => $text]);
        } else {
            $this->standartResponse();
        }
    }

    public function checkTokenStop(Request $request)
    {
        if ($request->hasValidSignature()) {
            $user = User::find($request->user);
            $title = 'VOLTOOID!';
            $text = 'Uw abonnement is stop gezet';
            if ($user->subscription()->first() !== null) {
                $subscription = Subscription::find($user->subscription()->first()->id);
                $subscription->delete();
            }
            return view('/pages/subscription/endingSubscription', ['title' => $title, 'text' => $text]);
        } else {
            $this->standartResponse();
        }
    }

    public function checkTokenEditAdress(Request $request)
    {
        if ($request->hasValidSignature()) {
            $user = User::find($request->user);
            $user->city = $request->city;
            $user->postcode = $request->postcode;
            $user->street_name = $request->street_name;
            $user->house_number = $request->house_number;
            $user->save();
            $title = 'VOLTOOID!';
            $text = 'Uw woonadres is geverifieerd en aangepast';
            SendEmailJob::dispatch('knstadskrant@gmail.com', new UserEditNotification($user->id));
            return view('/pages/subscription/endingSubscription', ['title' => $title, 'text' => $text]);
        } else {
            $this->standartResponse();
        }
    }

    public function checkTokenEditEmail(Request $request)
    {
        if ($request->hasValidSignature()) {
            $user = User::find($request->user);
            $user->email = $request->email;
            $user->save();
            $title = 'VOLTOOID!';
            $text = 'Uw email is geverifieerd en aangepast';
            SendEmailJob::dispatch('knstadskrant@gmail.com', new UserEditNotification($user->id));
            return view('/pages/subscription/endingSubscription', ['title' => $title, 'text' => $text]);
        } else {
            $this->standartResponse();
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
        if ($customer !== null && $customer->subscription()->first() !== null) {
            return back()->with('error', 'U heeft al een abonnement op het Keiennieuws')->withInput();
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

        $url = URL::temporarySignedRoute('subscribe', now()->addDays(1), ['user' => $user->id]);
        SendEmailJob::dispatch($user->email, new StartSubscription($url, $user));
        SendEmailJob::dispatch('knstadskrant@gmail.com', new StartSubscriptionNotification());

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
    {
        $validation =  $request->validate([
            'firstname' => ['required', 'string', 'max:255', 'min:3'],
            'lastname' => ['required', 'string', 'max:255', 'min:3'],
            'postcode' => 'required|postal_code:NL,DE,FR,BE',
            'email' =>  ['required', 'string', 'email', 'max:255'],
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user === null) {
            return back()->with('error', 'U heeft een verkeer e-mailadres opgegeven')->withInput();
        } else if ($user->subscription()->first() === null) {
            return back()->with('error', 'U heeft geen abonnement op het keiennieuws')->withInput();
        } else {
            $url = URL::temporarySignedRoute('unsubscribe', now()->addDays(1), ['user' => $user->id]);
            SendEmailJob::dispatch($user->email, new EndSubscription($url, $user));
            SendEmailJob::dispatch('knstadskrant@gmail.com', new EndSubscriptionNotification());
        }

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
        $user = Auth::user();
        return view('/pages/subscription/edit/stepTwoEditAdressSubscription', ['user' => $user]);
    }

    public function editAdressForm(Request $request)
    {
        $validation =  $request->validate([
            'email' =>  ['required', 'string', 'email', 'max:255'],
            'postcode' => 'required|postal_code:NL,DE,FR,BE',
            'house_number' => 'required|regex:/[0-9][a-z]?/',
            'street_name' => ['required', 'string', 'max:255', 'min:3'],
            'city' => ['required', 'string', 'max:255'],
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user !== null) {
            $url = URL::temporarySignedRoute('editinfoAdress', now()->addDays(1), [
                'user' => $user->id,
                'city' => $request->city,
                'street_name' => $validation['street_name'],
                'house_number' => $validation['house_number'],
                'postcode' => $request->postcode,
                'email' => $user->email
            ]);
            SendEmailJob::dispatch($user->email, new EditResidence($url, $user, $request->city, $request->house_number, $request->postcode, $request->street_name));
        } else {
            return back()->with('error', 'U heeft een verkeer e-mailadres opgegeven')->withInput();
        }
        return redirect('/subscription/editFinalAdress');
    }

    public function editEmail()
    {
        $user = Auth::user();
        return view('/pages/subscription/edit/stepTwoEditEmailSubscription', ['user' => $user]);
    }

    public function editEmailForm(Request $request)
    {
        $validation =  $request->validate([
            'confirmation_email' =>  ['required', 'string', 'email', 'max:255',],
            'email' => ['required', 'email', 'max:255', 'min:4', 'different:confirmation_email', 'unique:users']
        ]);

        $user = User::where('email', $request->confirmation_email)->first();
        if ($user !== null) {
            $url = URL::temporarySignedRoute('editinfoEmail', now()->addDays(1), [
                'user' => $user->id,
                'email' => $validation['email'],
            ]);
            SendEmailJob::dispatch($user->email, new EditEmail($url, $user, $validation['email']));
        } else {
            return back()->with('error', 'U heeft een verkeerd e-mailadres opgegeven')->withInput();
        }

        return redirect('/subscription/editFinalEmail');
    }

    public function editFinalEmail()
    {
        $title = 'UW EMAILADRES IS GEWIJZIGD';
        $text = 'U ontvangt binnen enkele minute een automatische email die naar uw oude emailadres wordt gestuurd.
        Dit wordt gedaan om te controleren of u wel de wijziging wilde maken.';
        return view('/pages/subscription/endingSubscription', ['title' => $title, 'text' => $text]);
    }

    public function editFinalAdress()
    {
        $title = 'UW BEZORGADRES IS GEWIJZIGD.';
        $text = 'U ontvangt binnen enkele minuten een bevestigingsmail van uw wijziging.';
        return view('/pages/subscription/endingSubscription', ['title' => $title, 'text' => $text]);
    }
}
