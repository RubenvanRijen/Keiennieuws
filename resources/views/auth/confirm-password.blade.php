@extends('layouts.app')

@section('content')
<div class="wrapper fadeInDown login-container">
    <div id="formContent">
        <div class="fadeIn first">
            <h1>KN</h1>
            <p>Keiennieuws</p>
        </div>
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf
            <div>
                <input id="password" placeholder="password" type="password" class="fadeIn second @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <input type="submit" class="fadeIn fourth" value="   {{ __('Bevestig wachtwoord') }}">
        </form>
        <div id="formFooter">
            @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Uw wachtwoord vergeten?') }}
            </a>
            @endif
        </div>
    </div>
</div>
@endsection