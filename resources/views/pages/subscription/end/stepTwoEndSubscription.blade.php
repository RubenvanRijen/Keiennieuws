@extends('layouts.app')

@section('content')
<div class="formSubscription stepTwoEndSubscription small-sibscription-form">
    <div class="container">
        <form id="start-subscription" action="{{ url('/subscription/endsteptwo') }}" method="POST">
            @csrf

            <div class="custom-input" style="margin-top: 6rem;">
                <label for="firtsname" class="form-label">Voornaam: </label>
                <input type="text" name="firstname" class="form-control" id="firstname" aria-describedby="voornaam">
            </div>
            <div class="custom-input">
                <label for="lastname" class="form-label">Achternaam: </label>
                <input type="text" name="lastname" class="form-control" id="lastname" aria-describedby="achternaam">
            </div>
            <div class="custom-input">
                <label for="emailadres" class="form-label">Emailadres: </label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="email">
            </div>
            <div class="custom-input">
                <label for="postcode" class="form-label">Postcode: </label>
                <input type="text" name="postcode" class="form-control" id="postcode" aria-describedby="postcode">
            </div>
            <div class="right-bottom-custom">
                <p>Bedankt voor het ivnullen.<br> Klik op de button om het af te ronden</p>
                <button type="submit" class="btn"><i class="arrow right"></i></button>
            </div>
        </form>
    </div>
</div>
@endsection