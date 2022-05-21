@extends('layouts.app')

@section('content')
<div class="formSubscription stepTwoEditEmailSubscription small-sibscription-form">
    <div class="container">
        <form id="start-subscription" action="{{ url('/subscription/editsteptwoemail') }}" method="POST">
            @csrf
            @if(session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session()->get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <p class="extra-info">Vul uw oude zowel als uw nieuwe emailafres in. Klik vervolgens op wijzigen</p>


            <div class="custom-input">
                <label for="confirmation_email" class="form-label">Oud emailadres: </label>
                <input type="email" class="form-control @error('confirmation_email') is-invalid @enderror" required value="{{old('confirmation_email') ?? ''}}" name="confirmation_email" class="form-control" id="confirmation_email" aria-describedby="email">
                @error('confirmation_email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="custom-input">
                <label for="emailadres" class="form-label">Nieuw emailadres: </label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" required value="{{old('email') ?? $user->email ?? ''}}" name="email" class="form-control" id="email" aria-describedby="email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-warning edit-button">Wijzigen</button>
        </form>
    </div>
</div>
@endsection