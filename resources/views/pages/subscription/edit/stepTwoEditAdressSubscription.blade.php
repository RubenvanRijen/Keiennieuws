@extends('layouts.app')

@section('content')
<div class="formSubscription stepTwoEditAdressSubscription small-sibscription-form">
    <div class="container">
        <form id="start-subscription" action="{{ url('/subscription/editsteptwoadress') }}" method="POST">
            @csrf
            <p class="extra-info">Vul uw nieuwe bezorgadres in, in combinatie met uw emailadres</p>
            <p>Bij het invullen vragen wij u de straat, huisnummer,postcode en woonplaatst te vermelden met uw emailadres</p>

            <div class="custom-input">
                <label for="emailadres" class="form-label">Emailadres: </label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="email">
            </div>

            <div class="row">
                <div class="col-9">
                    <div class="custom-input" style="margin-top: 1.8rem;">
                        <label for="street_name" class="form-label">Straat naam: </label>
                        <input type="text" name="street_name" class="form-control" id="street_name" aria-describedby="straat naam">
                    </div>
                </div>
                <div class="col-3">
                    <div class="custom-input" style="margin-top: 1.8rem;">
                        <label for="house_number" class="form-label">Huis nr: </label>
                        <input type="text" name="house_number" class="form-control" id="house_number" aria-describedby="Huisnummer">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-9">
                    <div class="custom-input">
                        <label for="postcode" class="form-label">Postcode: </label>
                        <input type="text" name="postcode" class="form-control" id="postcode" aria-describedby="postcode">
                    </div>
                </div>
                <div class="col-3">
                    <div class="custom-input">
                        <label for="city" class="form-label">Plaats: </label>
                        <input type="text" name="city" class="form-control" id="city" value="Megen" aria-describedby="Plaats">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-warning edit-button">Wijzigen</button>

        </form>
    </div>



</div>
@endsection