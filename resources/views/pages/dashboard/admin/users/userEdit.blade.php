@extends('layouts.cms')

@section('content')
<div class="container mt-5">
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
    <div class="card card-raised">
        <div class="card-header bg-primary text-white px-4">

            <div class="d-flex justify-content-between align-items-center">
                <div class="me-4">
                    <h2 class="card-title text-white mb-0">Gebruiker #{{$user->id}}</h2>
                    <div class="card-subtitle">Details and aanpassen</div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ url()->previous() }}">
                        <button value="view" name="action" type="submit" class="btn btn-primary ml-1 mr-1">
                            <i class="fs-3 bi bi-skip-backward-circle-fill"></i>
                        </button>
                    </a>
                    <a href="#">
                        <button value="view" name="action" type="submit" class="btn btn-primary ml-1 mr-1">
                            <i class="fs-3 bi bi-cloud-download-fill"></i>
                        </button>
                    </a> <a href="#">
                        <button value="view" name="action" type="submit" title="Terug" class="btn btn-primary ml-1 mr-1">
                            <i class="fs-3 bi bi-printer-fill"></i>
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <form class="p-3 ms-2" action="{{ url('/dashboard/admin/user-edit/'.$user->id)}}" method="post">
            @method('PATCH') @csrf

            <div class="field_input">
                <label class="form-label  ">Voornaam</label>
                <input id="firstname" type="text" placeholder="voornaam" class="form-control  fourth @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') ?? $user->firstname ?? '' }}" required autocomplete="firstname" autofocus>
                @error('firstname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="field_input">
                <label class="form-label  ">Achternaam</label>
                <input id="lastname" type="text" placeholder="achternaam" class="form-control  fourth @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname')?? $user->lastname ?? '' }}" required autocomplete="lastname" autofocus>
                @error('lastname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="field_input">
                <label class="form-label ">Nieuw email</label>
                <input type="text" placeholder="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $user->email??'' }}" required autocomplete="lastname" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="field_input">
                <label class="form-label  ">Postcode</label>
                <input id="postcode" type="text" placeholder="postcode" class="form-control  fourth @error('postcode') is-invalid @enderror" name="postcode" value="{{ old('postcode')?? $user->postcode ?? '' }}" required autocomplete="postcode" autofocus>
                @error('postcode')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="field_input">
                <label class="form-label  ">huisnummer</label>
                <input id="house_number" type="text" placeholder="huisnummer" class="form-control  fourth @error('house_number') is-invalid @enderror" name="house_number" value="{{ old('house_number')?? $user->house_number ?? '' }}" required autocomplete="house_number" autofocus>
                @error('house_number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="field_input">
                <label class="form-label  ">Stad/plaats</label>
                <input id="city" type="text" placeholder="plaats" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city')?? $user->city ?? '' }}" required autocomplete="city" autofocus>
                @error('city')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="field_input">
                <label class="form-label  ">Straatnaam</label>
                <input id="street_name" type="text" placeholder="straatnaam" class="form-control  @error('street_name') is-invalid @enderror" name="street_name" value="{{ old('street_name')?? $user->street_name ?? '' }}" required autocomplete="street_name" autofocus>
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
            <div class="field_input">
                <label class="form-label">Rechten</label>
                <select class="form-select" name="role">
                    <option @if ($role==='admin' )selected @endif value="admin">Admin</option>
                    <option @if ($role==='user' )selected @endif value="user">Gebruiker</option>
                </select>
            </div>
            <div class="text-end">
                <div class="form_button mt-3">
                    <button type="submit" class="btn btn-primary">Aanpassen</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection