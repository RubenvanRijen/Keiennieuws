@extends('layouts.app')

@section('content')
<div class="wrapper fadeInDown login-container">
    <div id="formContent">
        <div class="fadeIn first">
            <h1>KN</h1>
            <p>Keiennieuws</p>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <input id="email" placeholder="email" type="email" class="fadeIn second @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div>
                <input id="password" type="password" placeholder="password" class="fadeIn third @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <input type="submit" class="fadeIn fourth" value="Log In">
        </form>
        <div id="formFooter">
            @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
            <a class="btn btn-link" href="{{ route('register') }}">
                {{ __('Registreren?') }}
            </a>
            @endif
        </div>
    </div>
</div>
@endsection