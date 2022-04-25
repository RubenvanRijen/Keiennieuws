@extends('layouts.app')

@section('content')
<div class="place-booking-page">

    <div class="">
        <h1>PLAATS RESERVEREN</h1>
    </div>
    <div class="custom-shadow booking-data">
        <div class="container">
            <form id="start-subscription" action="{{ url('/placebooking') }}" method="POST">
                @csrf
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="custom-inputfields-width">
                                <label>Voor wlke editie wilt u een plek<br> reserveren?</p>
                                    <p>Wult u dezelfde publicatie voor langere tijd plaatsen? Selecteer meerdere edities.</p>
                                    <div class="custom-input" style="margin-top: 1.5rem;">
                                        <select id="inputState" class="form-select">
                                            <option selected>Choose...</option>
                                            <option>...</option>
                                        </select>
                                    </div>
                                    <div class="custom-input" style="margin-top: -0.2rem;">
                                        <label for="title" class="form-label">Titel van uw publicatie </label>
                                        <input type="text" name="title" class="form-control" id="title" aria-describedby="title">
                                    </div>
                            </div>
                        </div>
                        <!-- <div class="col-2"></div> -->
                        <div class="col">
                            <div class="custom-inputfields-width">
                                <div class="custom-input">
                                    <label for="title" class="form-label">Wat voor type publicatie is het? </label>
                                    <select id="inputState" class="form-select">
                                        <option selected>Choose...</option>
                                        <option>...</option>
                                    </select>
                                </div>
                                <div class="custom-input">
                                    <label for="title" class="form-label">Wat is het formaat van uw publicatie? </label>
                                    <select id="inputState" class="form-select">
                                        <option selected>Choose...</option>
                                        <option>...</option>
                                    </select>
                                </div>
                                <div class="custom-input">
                                    <label for="emailadres" class="form-label">Emailadres: </label>
                                    <input type="email" name="email" class="form-control" id="email" aria-describedby="email">
                                </div>
                                <button type="submit" class="btn btn-outline-success">Reserveren</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection