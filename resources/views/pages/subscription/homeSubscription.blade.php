@extends('layouts.app')

@section('content')
<div class="homeSubscription">
    <div class="container">
        <div class="begin-text">
            <h1>ABONNEMENT</h1>
            <p>Binnen enkele stappen uw abonnement regelen? Dat kan hier!</p>
        </div>
        <div class="row">
            <div class="col">
                <a href="/subscription/start" class="btn btn-warning title-text">Starten</a>
            </div>
            <div class="col">
                <a href="/subscription/end" class="btn btn-warning title-text">Eindigen
                </a>
            </div>
            <div class="col">
                <a href="/subscription/edit" class="btn btn-warning title-text">Wijzigen
                </a>
            </div>
        </div>
    </div>
</div>
@endsection