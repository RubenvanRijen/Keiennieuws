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
                <div class="card">
                    <div class="card-body">
                        <p class="card-text">Wanneer u een abonnement start dan is dat voor onbepaalde tijd. Een abonnement op het Keiennieuws kost per editie
                            1,50 euro. Elk jaar levert het keiennieuws 10 edities op. Dit begint in september en de laatste
                            editie van het jaar is in juni.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <a href="/subscription/end" class="btn btn-warning title-text">Eindigen </a>
                <div class="card">
                    <div class="card-body">
                        <p class="card-text">Wanneer u geen interesse meer heeft in het Keiennieuws, dan moet u dit voor de 25ste van de maand beëindigen.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <a href="/subscription/edit" class="btn btn-warning title-text">Wijzigen </a>
                <div class="card">
                    <div class="card-body">
                        <p class="card-text">Bent u verhuisd? Of heeft u een nieuw mailadres? geef dit kosteloos aan ons door.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection