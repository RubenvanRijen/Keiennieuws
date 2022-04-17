@extends('layouts.app')

@section('content')
<div class="introductionSubscriptionAction stepOneEditSubscription">
    <div class="container">
        <h2>Wat wilt u wijzigen?</h2>
        <div class="buttons-group-custom">
            <a href="/subscription/endsteptwo"><button class="btn btn-warning">Bezorgadres</button></a>
            <a href="/subscription/endsteptwo"><button class="btn btn-warning">Emailadres</button></a>
        </div>
    </div>
</div>
@endsection