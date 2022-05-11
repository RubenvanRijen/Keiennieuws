@extends('layouts.app')

@section('content')
<div class="formSubscription stepTwoStartSubscription">
    <div class="container">
        <form id="start-subscription" action="{{ url('/subscription/startsteptwo') }}" method="POST">
            @csrf
            @if(session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session()->get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="row">
                <div class="col left-side">
                    <div class="row gender-checkboxes">
                        <div class="col form-check">
                            <input name="gender" class="form-check-input" type="checkbox" value="Dhr" id="male-gender" @if ((old('gender') && old('gender')==='Dhr' ) || (!old('gender') && $user && $user->gender === 'Dhr')) checked @endif>
                            <label class="form-check-label " for="flexCheckDefault">
                                Dhr
                            </label>
                        </div>
                        <div class="col form-check">
                            <input name="gender" class="form-check-input" type="checkbox" value="Mevr" id="female-gender" @if ((old('gender') && old('gender')==='Mevr' ) || (!old('gender') && $user && $user->gender === 'Mevr')) checked @endif>
                            <label class="form-check-label" for="flexCheckDefault">
                                Mevr
                            </label>
                        </div>
                        <div class="col form-check">
                            <input name="gender" class="form-check-input" type="checkbox" value="Anders" id="other-gender" @if ((old('gender') && old('gender')==='Anders' ) || (!old('gender') && $user && $user->gender === 'Anders'))checked @endif>
                            <label class="form-check-label" for="flexCheckDefault">
                                Anders
                            </label>
                        </div>
                    </div>
                    <div class="custom-input" style="margin-top: 6rem;">
                        <label for="firtsname" class="form-label">Voornaam: </label>
                        <input value="{{ old('firstname') ?? $user->firstname ?? null }}" required class="form-control @error('firstname') is-invalid @enderror" type="text" name="firstname" required class="form-control" id="firstname" aria-describedby="voornaam">
                        @error('firstname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="custom-input">
                        <label for="lastname" class="form-label">Achternaam: </label>
                        <input value="{{ old('lastname')?? $user->lastname?? null }}" required class="form-control @error('lastname') is-invalid @enderror" type="text" name="lastname" class="form-control" id="lastname" aria-describedby="achternaam">
                        @error('lastname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="custom-input">
                        <label for="emailadres" class="form-label">Emailadres: </label>
                        <input value="{{ old('email')?? $user->email?? null }}" required class="form-control @error('email') is-invalid @enderror" type="email" name="email" class="form-control" id="email" aria-describedby="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <p>Op welk adres wilt u dat het Keiennieuws bezorgd wordt?</p>
                    <div class="row">
                        <div class="col-9">
                            <div class="custom-input" style="margin-top: 1.8rem;">
                                <label for="street_name" class="form-label">Straat naam: </label>
                                <input value="{{ old('street_name')?? $user->street_name ?? null}}" required class="form-control @error('street_name') is-invalid @enderror" type="text" name="street_name" class="form-control" id="street_name" aria-describedby="straat naam">
                                @error('street_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="custom-input" style="margin-top: 1.8rem;">
                                <label for="house_number" class="form-label">Huis nr: </label>
                                <input value="{{ old('house_number')?? $user->house_number ?? null}}" required class="form-control @error('house_number') is-invalid @enderror" type="text" name="house_number" class="form-control" id="house_number" aria-describedby="Huisnummer">
                                @error('house_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-9">
                            <div class="custom-input">
                                <label for="postcode" class="form-label">Postcode: </label>
                                <input value="{{ old('postcode')?? $user->postcode ?? null}}" required class="form-control @error('postcode') is-invalid @enderror" type="text" name="postcode" class="form-control" id="postcode" aria-describedby="postcode">
                                @error('postcode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="custom-input">
                                <label for="city" class="form-label">Plaats: </label>
                                <input class="form-control @error('city') is-invalid @enderror" required type="text" name="city" class="form-control" id="city" value="{{ old('city') ?? $user->city?? 'Megen' }}" aria-describedby="Plaats">
                                @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
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