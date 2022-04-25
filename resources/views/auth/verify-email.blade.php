@extends('layouts.app')

@section('content')
<div class="wrapper fadeInDown login-container">
    <div id="formContent">
        <div class="fadeIn first">
            <h1>KN</h1>
            <p>Keiennieuws</p>
        </div>
        <div class="">
            <span class="font-weight-bolder">{{ __('Verifieer uw emailadress') }}</span>

            <div class="card-body">
                @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('Er is een nieuwe verificatielink naar uw emailadres gestuurd.') }}
                </div>
                @endif

                {{ __('Controleer voordat u verder gaat uw email voor een verificatielink.') }}
                {{ __('Als u de email niet heeft ontvangen') }},

            </div>
        </div>
        <div id="formFooter">
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('klik hier om een nieuwe aan te vragen') }}</button>
                .
            </form>
        </div>
    </div>
</div>
@endsection