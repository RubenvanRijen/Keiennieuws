@extends('layouts.cms')

@section('content')
<div class="dashboard_users">
    <div class="container">
        @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session()->get('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <h1 class="fadeIn first">Uw gegevens</h1>
        <hr class="fadeIn second">
        <form action="{{ url('/dashboard/person-information/edit/'.$user->id)}}" method="post">
            @method('PATCH') @csrf

            <div class="field_input">
                <label class="form-label fadeIn third">Voornaam</label>
                <input id="firstname" type="text" placeholder="voornaam" class="form-control fadeIn fourth @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') ?? $user->firstname ?? '' }}" required autocomplete="firstname" autofocus>
                @error('firstname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="field_input">
                <label class="form-label fadeIn third">Achternaam</label>
                <input id="lastname" type="text" placeholder="achternaam" class="form-control fadeIn fourth @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname')?? $user->lastname ?? '' }}" required autocomplete="lastname" autofocus>
                @error('lastname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="field_input">
                <label class="form-label fadeIn third">Postcode</label>
                <input id="postcode" type="text" placeholder="postcode" class="form-control fadeIn fourth @error('postcode') is-invalid @enderror" name="postcode" value="{{ old('postcode')?? $user->postcode ?? '' }}" required autocomplete="postcode" autofocus>
                @error('postcode')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="field_input">
                <label class="form-label fadeIn third">huisnummer</label>
                <input id="house_number" type="text" placeholder="huisnummer" class="form-control fadeIn fourth @error('house_number') is-invalid @enderror" name="house_number" value="{{ old('house_number')?? $user->house_number ?? '' }}" required autocomplete="house_number" autofocus>
                @error('house_number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="field_input">
                <label class="form-label fadeIn third">Stad/plaats</label>
                <input id="city" type="text" placeholder="plaats" class="form-control fadeIn fourth @error('city') is-invalid @enderror" name="city" value="{{ old('city')?? $user->city ?? '' }}" required autocomplete="city" autofocus>
                @error('city')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="field_input">
                <label class="form-label fadeIn third">Straatnaam</label>
                <input id="street_name" type="text" placeholder="straatnaam" class="form-control fadeIn fourth @error('street_name') is-invalid @enderror" name="street_name" value="{{ old('street_name')?? $user->street_name ?? '' }}" required autocomplete="street_name" autofocus>
                @error('street_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="field_input">
                <label class="form-label">Geslacht</label>
                <select class="form-select" name="gender">
                    <option @if ($user->gender === 'Dhr')selected @endif value="Dhr">Man</option>
                    <option @if ($user-> gender === 'Mevr')selected @endif value="Mevr">Vrouw</option>
                    <option @if ($user-> gender === 'Anders')selected @endif value="Anders">Anders</option>
                </select>
            </div>
            <div class="form_button fadeIn third">
                <button type="submit" class="btn btn-primary">Aanpassen</button>
            </div>
        </form>



    </div>
    <script type="text/javascript">

    </script>
    @endsection