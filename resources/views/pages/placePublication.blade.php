@extends('layouts.app')

@section('content')
<div class="place-publication-page">
    <div class="row place-publication-row">
        <div class="content-title">
            <h1>JOUW PUBLICATIE AANLEVEREN</h1>
        </div>
        <div class="col left-column">
            <form id="start-subscription" action="{{ url('/placepublication') }}" method="POST">
                @csrf
                @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session()->get('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
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
                        <p>Welke bestanden wilt u aanleveren voor uw publicatie in het Keiennieuws?</p>
                        <label for="formFileMultiple" class="form-label">U kunt ook meerdere foto's tegelijkertijd uploaden</label>
                        <input required class="form-control custom-file-input @error('file') is-invalid @enderror @error('file.*') is-invalid @enderror" name="file[]" type="file" id="formFileMultiple" multiple>
                        <span id="uploadedFilesMessage" class="d-none">Gekozen bestanden:</span>
                        <span id="maxFilesMessage" class="invalid-feedback d-none" role="alert">
                            <strong>U kunt maximaal 5 bestanden tegelijk aanleveren</strong>
                        </span>
                        <div id="fileList"></div>
                        @error('file')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        @error('file.*')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="custom-input">
                        <label for="title" class="form-label">Wat voor type publicatie is het? </label>
                        <select name="type" id="type" required class="form-select @error('type') is-invalid @enderror">
                            @foreach ($types as $type => $name)
                            <option value="{{$type}}" {{ (old("type") == $type ? "selected":"") }}>{{$name}}</option>
                            @endforeach
                        </select>
                        @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="custom-input" style="margin-top: -0.2rem;">
                        <label for="title" class="form-label">Titel van uw publicatie </label>
                        <input value="{{ old('title')?? '' }}" class="form-control @error('title') is-invalid @enderror" type="text" name="title" class="form-control" id="title" aria-describedby="title">
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="custom-input editions-select">
                        <label for="title" class="form-label">In welke edit moet het geplaatst worden?</label>
                        <select required name="edition[]" multiple multiselect-max-items="7" multiselect-search="true" multiselect-select-all="true" id="edition" class="form-control mt-1 select-checkbox-fa @error('edition') is-invalid @enderror">
                            @foreach ($editions as $edition)
                            <option value="{{$edition->id}}" {{ (collect(old('edition'))->contains($edition->id)) ? 'selected':'' }}>{{$edition->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="extra-info-custom">
                        <div class="custom-input">
                            <label for="title" class="form-label">Wat is het formaat van uw publicatie? </label>
                            <select name="size" id="size" required class="form-select @error('size') is-invalid @enderror">
                                @foreach ($sizes as $key =>$value)
                                <option value="{{$key}}" {{ (old("size") == $key ? "selected":"") }}>{{$value}}</option>
                                @endforeach
                            </select>
                            @error('size')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
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
                        <input required value="{{ old('email')??$user->email?? '' }}" class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" aria-describedby="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Waar moet het keiennieuws rekening mee houden met uw publicatie?</label>
                        <textarea class="form-control" name="information" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="custom-submit-right">
                        <button type="submit" class="btn btn-outline-success">Aanleveren</button>
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