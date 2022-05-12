@extends('layouts.app')

@section('content')
<div class="formSubscription stepTwoEditAdressSubscription small-sibscription-form">
    <div class="container">
        <form id="start-subscription" action="{{ url('/subscription/editsteptwoadress') }}" method="POST">
            @csrf
            @if(session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session()->get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <p class="extra-info">Vul uw nieuwe bezorgadres in, in combinatie met uw emailadres</p>
            <p>Bij het invullen vragen wij u de straat, huisnummer,postcode en woonplaatst te vermelden met uw emailadres</p>

            <div class="custom-input">
                <label for="emailadres" class="form-label">Emailadres: </label>
                <input type="email" value="{{ old('email')?? $user->email?? '' }}" class="form-control @error('email') is-invalid @enderror" required name="email" class="form-control" id="email" aria-describedby="email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="row">
                <div class="col-9">
                    <div class="custom-input" style="margin-top: 1.8rem;">
                        <label for="street_name" class="form-label">Straat naam: </label>
                        <input type="text" value="{{ old('street_name')?? $user->street_name?? '' }}" class="form-control @error('street_name') is-invalid @enderror" required name="street_name" class="form-control" id="street_name" aria-describedby="straat naam">
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
                        <input type="text" value="{{ old('house_number')?? $user->house_number?? '' }}" class="form-control @error('house_number') is-invalid @enderror" required name="house_number" class="form-control" id="house_number" aria-describedby="Huisnummer">
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
                        <input type="text" value="{{ old('postcode')?? $user->postcode?? '' }}" class="form-control @error('postcode') is-invalid @enderror" required name="postcode" class="form-control" id="postcode" aria-describedby="postcode">
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
                        <input type="text" value="{{ old('city')?? $user->city?? '' }}" name="city" class="form-control @error('city') is-invalid @enderror" required class="form-control" id="city" value="Megen" aria-describedby="Plaats">
                        @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-warning edit-button">Wijzigen</button>

        </form>
    </div>



</div>
@endsection