<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $rule = ['required', 'string', 'email', 'max:255', 'unique:users', 'confirmed'];
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        if ($user !== null && Auth::attempt(['email' => $email, 'password' => 'Test123?'])) {
            $request->session()->regenerate();
            $rule = ['required', 'string', 'email', 'max:255', 'confirmed'];
        }

        $request->validate([
            'firstname' => ['required', 'string', 'max:20', 'min:3'],
            'lastname' => ['required', 'string', 'max:20', 'min:3'],
            'postcode' => 'required|postal_code:NL,DE,FR,BE',
            'house_number' => 'required',
            'city' => ['required', 'string', 'max:25', 'min:3'],
            'street_name' => ['required', 'string', 'max:25', 'min:3'],
            'email' => $rule,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::updateOrCreate(
            ['email' => $request->email],
            [
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'postcode' => $request->postcode,
                'house_number' => $request->house_number,
                'city' => $request->city,
                'gender' => 'Dhr/Mevr',
                'street_name' => $request->street_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]
        );

        $user->assignRole('user');

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
