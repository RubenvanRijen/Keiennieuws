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

        <h1 class="fadeIn first">Uw email</h1>
        <hr class="fadeIn second">
        <form action="{{ url('/dashboard/person-security/editEmail/'.$user->id)}}" method="post">
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


        <h1 class="fadeIn first">Uw wachtwoord</h1>
        <hr class="fadeIn second">
        <form action="{{ url('/dashboard/person-security/password/'.$user->id)}}" method="post">
            @csrf
            <div class="field_input">
                <label class="form-label fadeIn third">Oud wachtwoord</label>
                <input type="text" placeholder="oud wachtwoord" class="form-control fadeIn fourth @error('old_password') is-invalid @enderror" name="old_password" value="{{ old('old_password') ?? '' }}" required autocomplete="firstname" autofocus>
                @error('old_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="field_input">
                <label class="form-label fadeIn third">Nieuw wachtwoord</label>
                <input type="text" placeholder="nieuw wachtwoord" class="form-control fadeIn fourth @error('new_password') is-invalid @enderror" name="new_password" value="{{ old('new_password')?? '' }}" required autocomplete="lastname" autofocus>
                @error('new_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form_button fadeIn third">
                <button type="submit" class="btn btn-primary">Aanpassen</button>
            </div>
        </form>






    </div>
    <script type="text/javascript">

    </script>
    @endsection