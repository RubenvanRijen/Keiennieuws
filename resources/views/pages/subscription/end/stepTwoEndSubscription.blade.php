@extends('layouts.app')

@section('content')
<div class="formSubscription stepTwoEndSubscription small-sibscription-form">
    <div class="container">
        <form id="start-subscription" action="{{ url('/subscription/endsteptwo') }}" method="POST">
            @csrf
            @if(session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session()->get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="custom-input">
                <label for="firtsname" class="form-label">Voornaam: </label>
                <input type="text" class="form-control @error('firstname') is-invalid @enderror" value="{{old('firstname') ?? $user->firstname ?? ''}}" required name="firstname" class="form-control" id="firstname" aria-describedby="voornaam">
                @error('firstname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="custom-input">
                <label for="lastname" class="form-label">Achternaam: </label>
                <input type="text" class="form-control @error('lastname') is-invalid @enderror" value="{{old('lastname') ?? $user->lastname ?? ''}}" required name="lastname" class="form-control" id="lastname" aria-describedby="achternaam">
                @error('lastname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="custom-input">
                <label for="emailadres" class="form-label">Emailadres: </label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email') ?? $user->email ?? ''}}" required name="email" class="form-control" id="email" aria-describedby="email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="custom-input">
                <label for="postcode" class="form-label">Postcode: </label>
                <input type="text" class="form-control @error('postcode') is-invalid @enderror" value="{{old('postcode') ?? $user->postcode ?? ''}}" required name="postcode" class="form-control" id="postcode" aria-describedby="postcode">
                @error('postcode')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="right-bottom-custom">
                <p>Bedankt voor het ivnullen.<br> Klik op de button om het af te ronden</p>
                <button type="submit" class="btn"><i class="arrow right"></i></button>
            </div>
        </form>
    </div>
</div>
@endsection