@extends('layouts.app')

@section('content')
<div class="place-publication-page">
    <div class="row place-publication-row">
        <div class="content-title">
            <h1>JOUW PUBLICATIE AANLEVEREN</h1>
        </div>
        <div class="col left-column">
            <form id="start-subscription" action="{{ url('/placePublication') }}" method="POST">
                @csrf
                <div class="container form-container-custom">
                    <label style="margin-bottom: 1rem;"> Heeft u een plek gereserveerd?</label>
                    <div class="custom-input place-booking-checkboxes">
                        <div class="form-check">
                            <input name="placedBooking" class="form-check-input" type="checkbox" value="" id="placedBooking">
                            <label class="form-check-label" for="placedBooking">
                                Ja
                            </label>
                        </div>
                        <div class="form-check" style="margin-left: 4rem;">
                            <input name="placedBooking" class="form-check-input" type="checkbox" value="" id="placedNoBooking">
                            <label class="form-check-label" for="placedNoBooking">
                                Nee
                            </label>
                        </div>
                    </div>
                    <div class="custom-input custom-file-input">
                        <label>Kies het bestand wat u wilt aanleveren</label>
                        <input class="form-control" type="file" id="formFileMultiple" multiple>
                        <span id="uploadedFilesMessage" class="d-none">Gekozen bestanden:</span>
                        <span id="maxFilesMessage" class="invalid-feedback d-none" role="alert">
                            <strong>U kunt maximaal 5 bestanden tegelijk aanleveren</strong>
                        </span>
                        <div id="fileList"></div>
                    </div>
                    <div class="custom-input">
                        <label for="title" class="form-label">Wat voor type publicatie is het?</label>
                        <select id="inputState" class="form-select">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                    </div>
                    <div class="custom-input">
                        <label for="title" class="form-label">In welke edit moet het geplaatst worden?</label>
                        <select id="inputState" class="form-select">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                    </div>

                    <div class="extra-info-custom">
                        <div class="custom-input">
                            <label for="title" class="form-label">Wat is het formaat van uw publicatie?</label>
                            <select id="inputState" class="form-select">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                        </div>
                        <label>Gelijk uw plek reserveren?</label>
                        <p>Als u een plek reserveerd, dan kunt u ervan uitgaan dat uw aangeleverde publicatie in het aangegeven Keiennieuws komt.</p>
                        <div class="custom-input place-booking-checkboxes">
                            <div class="form-check">
                                <input name="placeBooking" class="form-check-input" type="checkbox" value="" id="placeBooking">
                                <label class="form-check-label" for="placeBooking">
                                    Ja
                                </label>
                            </div>
                            <div class="form-check" style="margin-left: 4rem;">
                                <input name="placeBooking" class="form-check-input" type="checkbox" value="" id="placeNoBooking">
                                <label class="form-check-label" for="placeNoBooking">
                                    Nee
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="custom-input">
                        <label for="emailadres" class="form-label">Emailadres: </label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="email">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Waar moet het keiennieuws rekening mee houden met uw publicatie?</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="custom-submit-right">
                        <button disabled type="submit" class="btn btn-outline-success">Aanleveren</button>
                        <p>U kunt op het moment nog niet aanleveren, de mogelijkheid komt er snel aan</p>
                    </div>
                </div>
            </form>
        </div>
        <div class="col right-column">
            <h1>JOUW PUBLICATIE AANLEVEREN</h1>
        </div>
    </div>
</div>
@endsection