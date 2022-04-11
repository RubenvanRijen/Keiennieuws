@extends('layouts.app')

@section('content')
<div class="eindingSubscription">
    <div class="container">
        <h1 class="custom-title">VOLTOOID!</h1>
        <p class="custom-explenation">Binnen nu en 7 dagen ontvangt u een bevestigingsemail.
            het redactie team wenst u veel lees plezier.
        </p>
        <small>U wordt binnen </small><small id="timer" data-time="10">10</small><small> secondes doorgestuurd
            anders klik op deze <a href="{{ url('/') }}">link</a></small>
    </div>
</div>
<?php
header("Refresh:11; url=/");
?>
@endsection