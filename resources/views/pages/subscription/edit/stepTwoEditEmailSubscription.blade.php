@extends('layouts.app')

@section('content')
<div class="formSubscription stepTwoEditEmailSubscription small-sibscription-form">
    <div class="container">
        <form id="start-subscription" action="{{ url('/subscription/editsteptwoemail') }}" method="POST">
            @csrf
            <p class="extra-info">Vul uw oude zowel als uw nieuwe emailafres in. Klik vervolgens op wijzigen</p>

            <div class="custom-input">
                <label for="emailadres" class="form-label">Oud emailadres: </label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="email">
            </div>
            <div class="custom-input">
                <label for="confirmation-emailadres" class="form-label">Nieuw emailadres: </label>
                <input type="email" name="confirmation-email" class="form-control" id="confirmation-email" aria-describedby="email">
            </div>

            <button type="submit" class="btn btn-warning edit-button">Wijzigen</button>
        </form>
    </div>
</div>
@endsection