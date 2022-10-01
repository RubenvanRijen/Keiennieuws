@extends('layouts.app')

@section('content')
<div class="dashboard_users">
    <div class="container">
        <h1>Uw gegevens</h1>
        <hr>
        <form>
            @csrf
            <div class="field_input">
                <label class="form-label fadeIn first">Voornaam</label>
                <input id="firstname" type="text" placeholder="voornaam" class="form-control fadeIn second @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') ?? $user->firstname ?? '' }}" required autocomplete="firstname" autofocus>
                @error('firstname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="field_input">
                <label class="form-label fadeIn first">Achternaam</label>
                <input id="lastname" type="text" placeholder="achternaam" class="form-control fadeIn second @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname')?? $user->lastname ?? '' }}" required autocomplete="lastname" autofocus>
                @error('lastname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="field_input">
                <label class="form-label fadeIn first">Postcode</label>
                <input id="postcode" type="text" placeholder="postcode" class="form-control fadeIn second @error('postcode') is-invalid @enderror" name="postcode" value="{{ old('postcode')?? $user->postcode ?? '' }}" required autocomplete="postcode" autofocus>
                @error('postcode')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="field_input">
                <label class="form-label fadeIn first">huisnummer</label>
                <input id="house_number" type="number" placeholder="huisnummer" class="form-control fadeIn second @error('house_number') is-invalid @enderror" name="house_number" value="{{ old('house_number')?? $user->house_number ?? '' }}" required autocomplete="house_number" autofocus>
                @error('house_number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="field_input">
                <label class="form-label fadeIn first">Stad/plaats</label>
                <input id="city" type="text" placeholder="plaats" class="form-control fadeIn second @error('city') is-invalid @enderror" name="city" value="{{ old('city')?? $user->city ?? '' }}" required autocomplete="city" autofocus>
                @error('city')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="field_input">
                <label class="form-label fadeIn first">Straatnaam</label>
                <input id="street_name" type="text" placeholder="straatnaam" class="form-control fadeIn second @error('street_name') is-invalid @enderror" name="street_name" value="{{ old('street_name')?? $user->street_name ?? '' }}" required autocomplete="street_name" autofocus>
                @error('street_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form_button fadeIn first">
                <button type="submit" class="btn btn-primary">Aanpassen</button>
            </div>
        </form>

        <h1>Uw Reserveringen/Publicaties</h1>
        <hr>
        <div class="row">
            @foreach ($bookings as $booking )
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{$booking->title}}</h5>
                        <p class="card-subtitle mb-1">Type: {{$booking->type}}</p>
                        <p class="card-subtitle mb-1">Groote: {{$booking->size}}</p>
                        <p class="card-subtitle mb-1">Gemaakt op: {{$booking->created_at}}</p>

                        <p class="card-subtitle mb-1">Edities:
                            @foreach ($booking->editions()->get() as $edition)
                            {{$edition->title}} ,
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection