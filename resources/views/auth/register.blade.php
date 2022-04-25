@extends('layouts.app')

@section('content')

<div class="wrapper fadeInDown login-container">
    <div id="formContent">
        <div class="fadeIn first">
            <h1>KN</h1>
            <p>Keiennieuws</p>
        </div>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="row">
                <div class="col">
                    <div>
                        <input id="firstname" type="text" placeholder="voornaam" class="fadeIn second @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>
                        @error('firstname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <input id="lastname" type="text" placeholder="achternaam" class="fadeIn second @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>
                        @error('lastname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <input placeholder="email" id="email" type="email" class="fadeIn third @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <input placeholder="email herhalen" id="email_confirmation" type="email" class="fadeIn third @error('email_confirmation') is-invalid @enderror" name="email_confirmation" value="{{ old('email_confirmation') }}" required autocomplete="email_confirmation">
                        @error('email_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div>
                        <input id="postcode" type="text" placeholder="postcode" class="fadeIn second @error('postcode') is-invalid @enderror" name="postcode" value="{{ old('postcode') }}" required autocomplete="postcode" autofocus>
                        @error('postcode')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <input id="house_number" type="number" placeholder="huisnummer" class="fadeIn second @error('house_number') is-invalid @enderror" name="house_number" value="{{ old('house_number') }}" required autocomplete="house_number" autofocus>
                        @error('house_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <input id="city" type="text" placeholder="plaats" class="fadeIn second @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="city" autofocus>
                        @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <input id="street_name" type="text" placeholder="straatnaam" class="fadeIn second @error('street_name') is-invalid @enderror" name="street_name" value="{{ old('street_name') }}" required autocomplete="street_name" autofocus>
                        @error('street_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                </div>
                <div>
                    <div class="password-field">
                        <input placeholder="wachtwoord" id="password" type="password" class="fadeIn fourth @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <div>
                            <input placeholder="wachtwoord herhalen" id="password-confirm" type="password" class="fadeIn fifth" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                </div>
            </div>




            <input type="submit" class="fadeIn sixth" value="Register">
        </form>
        <div id="formFooter">

            <a class="btn btn-link" href="{{ url('/login') }}">
                Al een account?
            </a>
        </div>
    </div>
</div>
@endsection