@extends('layouts.app')

@section('content')
<div class="wrapper fadeInDown login-container">
    <div id="formContent">
        <div class="fadeIn first">
            <h1>KN</h1>
            <p>Keiennieuws</p>
        </div>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token')  }}">

            <div>
                <input id="email" placeholder="email" type="email" class="fadeIn second @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div>
                <input id="password" type="password" placeholder="password" class="fadeIn third @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div>
                <input id="password-confirm" type="password" class="fadeIn fourth" placeholder="password confirmation" name="password_confirmation" required autocomplete="new-password">
            </div>
            <input type="submit" class="fadeIn fifth" value="Reset">
        </form>
    </div>
</div>
@endsection