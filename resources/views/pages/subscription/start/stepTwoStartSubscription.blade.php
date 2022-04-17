@extends('layouts.app')

@section('content')
<div class="formSubscription stepTwoStartSubscription">
    <div class="container">
        <form id="start-subscription" action="{{ url('/subscription/startsteptwo') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col left-side">
                    <div class="row gender-checkboxes">
                        <div class="col form-check">
                            <input name="gender" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Dhr
                            </label>
                        </div>
                        <div class="col form-check">
                            <input name="gender" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Mevr
                            </label>
                        </div>
                        <div class="col form-check">
                            <input name="gender" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Anders
                            </label>
                        </div>
                    </div>
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
                </div>
                <div class="col">
                    <p>Op welk adres wilt u dat het Keiennieuws bezorgd wordt?</p>
                    <div class="row">
                        <div class="col-9">
                            <div class="custom-input" style="margin-top: 1.8rem;">
                                <label for="street_name" class="form-label">Straat naam: </label>
                                <input type="text" name="street_name" class="form-control" id="street_name" aria-describedby="straat naam">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="custom-input" style="margin-top: 1.8rem;">
                                <label for="house_number" class="form-label">Huis nr: </label>
                                <input type="text" name="house_number" class="form-control" id="house_number" aria-describedby="Huisnummer">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-9">
                            <div class="custom-input">
                                <label for="postcode" class="form-label">Postcode: </label>
                                <input type="text" name="postcode" class="form-control" id="postcode" aria-describedby="postcode">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="custom-input">
                                <label for="city" class="form-label">Plaats: </label>
                                <input type="text" name="city" class="form-control" id="city" value="Megen" aria-describedby="Plaats">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-bottom-custom">
                <p>Bedankt voor het invullen.<br> Klik op de button om het af te ronden</p>
                <button type="submit" class="btn"><i class="arrow right"></i></button>
            </div>
        </form>
    </div>
</div>
@endsection