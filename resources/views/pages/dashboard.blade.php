@extends('layouts.app')

@section('content')
<div class="dashboard_users">
    <div class="container">
        <h1 class="fadeIn first">Uw gegevens</h1>
        <hr class="fadeIn second">
        <form>
            @csrf
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
            <div class="form_button fadeIn third">
                <button type="submit" class="btn btn-primary">Aanpassen</button>
            </div>
        </form>


        <h1 class="fadeIn first">Uw wachtwoord</h1>
        <hr class="fadeIn second">
        <form>
            @csrf
            <div class="field_input">
                <label class="form-label fadeIn third">Oud wachtwoord</label>
                <input type="text" placeholder="oud wachtwoord" class="form-control fadeIn fourth @error('old-password') is-invalid @enderror" name="old-password" value="{{ old('old-password') ?? '' }}" required autocomplete="firstname" autofocus>
                @error('old-password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="field_input">
                <label class="form-label fadeIn third">Nieuw wachtwoord</label>
                <input type="text" placeholder="nieuw wachtwoord" class="form-control fadeIn fourth @error('new-password') is-invalid @enderror" name="new-password" value="{{ old('new-password')?? '' }}" required autocomplete="lastname" autofocus>
                @error('new-password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form_button fadeIn third">
                <button type="submit" class="btn btn-primary">Aanpassen</button>
            </div>
        </form>


        <h1 class="fadeIn first">Uw email</h1>
        <hr class="fadeIn second">
        <form>
            @csrf
            <div class="field_input">
                <label class="form-label fadeIn third">Oude email</label>
                <input type="text" placeholder="oude email" class="form-control fadeIn fourth @error('old-email') is-invalid @enderror" name="old-email" value="{{ old('old-email') ?? '' }}" required autocomplete="firstname" autofocus>
                @error('old-email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="field_input">
                <label class="form-label fadeIn third">Nieuw email</label>
                <input type="text" placeholder="nieuwe email" class="form-control fadeIn fourth @error('new-email') is-invalid @enderror" name="new-email" value="{{ old('new-email')?? '' }}" required autocomplete="lastname" autofocus>
                @error('new-email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form_button fadeIn third">
                <button type="submit" class="btn btn-primary">Aanpassen</button>
            </div>
        </form>

        <h1 class="fadeIn first">Uw Reserveringen/Publicaties</h1>
        <hr class="fadeIn second">
        <div class="booking_publications_overview fadeIn third">
            <div class="row ">
                @foreach ($bookings as $booking )
                <div class="col fadeIn fourth">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">#{{ $loop->index + 1 }} - {{$booking->title}}</h5>
                            <hr>
                            <p class="card-subtitle">Type: {{$booking->type}}</p>
                            <p class="card-subtitle">Groote: {{$booking->size}}</p>
                            <p class="card-subtitle">Gemaakt op: {{$booking->created_at}}</p>
                            <p class="card-subtitle mb-1">Edities:
                                @foreach ($booking->editions()->get() as $edition)
                                {{$edition->title}} ,
                                @endforeach
                            </p>
                            <form action="{{ url('/dashboard/bookings/delete/'.$booking->id)}}" method="post" enctype="multipart/form-data">@method('DELETE') @csrf
                                <button type="sumbit" @if (in_array($booking->id, $allowedBookings)) disabled @endif class="btn btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                    Verwijderen
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection