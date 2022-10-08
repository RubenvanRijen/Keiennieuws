@extends('layouts.app')

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
        <form action="{{ url('/dashboard/user/edit/'.$user->id)}}" method="post">
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
        <form action="{{ url('/dashboard/user/editEmail/'.$user->id)}}" method="post">
            @csrf
            <div class="field_input">
                <label class="form-label fadeIn third">Oude email</label>
                <input type="text" placeholder="oude email" class="form-control fadeIn fourth @error('old_email') is-invalid @enderror" name="old_email" value="{{ old('old_email') ?? $user->email??'' }}" required autocomplete="firstname" autofocus>
                @error('old_email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="field_input">
                <label class="form-label fadeIn third">Nieuw email</label>
                <input type="text" placeholder="nieuwe email" class="form-control fadeIn fourth @error('email') is-invalid @enderror" name="email" value="{{ old('email')?? '' }}" required autocomplete="lastname" autofocus>
                @error('email')
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
            @if (count($bookings) === 0)
            <h4>U heeft nog geen reserveringen geplaatst</h4>
            @endif
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
                            <form action="{{ url('/dashboard/bookings/delete/'.$booking->id)}}" id="deleteBookingDashboard" method="post" enctype="multipart/form-data">@method('DELETE') @csrf
                                <button onclick="deleteBooking();" type="sumbit" @if (in_array($booking->id, $allowedBookings)) disabled @endif class="btn btn-outline-danger show_confirm_delete_booking_dashboard">
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
<script type="text/javascript">

</script>
@endsection