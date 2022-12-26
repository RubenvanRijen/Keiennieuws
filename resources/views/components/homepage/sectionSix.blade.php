<div class="container">
    <div class="row">
        <div class="col left-side">
            <h1>{{$simpleVolunteers[0]->title}}</h1>
            <div>
                {!! $simpleVolunteers[0]->information !!}
            </div>
        </div>

        <div class="col right-side">
            <form id="volunteerapplication" action="{{ url('/home/volunteerapplication') }}" method="POST">
                @csrf
                <div class="form-group" style="display: none;">
                    <label for="faxonly">
                        <input type="checkbox" name="botTest" id="botTest" />
                    </label>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Naam:</label>
                    <input required type="text" value="{{ old('nameVolunteer')?? '' }}" name="nameVolunteer" class="form-control @error('nameVolunteer') is-invalid @enderror" id="name" aria-describedby="name">
                    @error('nameVolunteer')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Uw e-mailadres: </label>
                    <input required type="email" name="email" value="{{ old('email')?? '' }}" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Wat is uw reden tot aanmelding?</label>
                    <textarea required name="explenation" class="form-control @error('explenation') is-invalid @enderror" maxlength="300" id="explenation" rows="3">{{ old('explenation')?? '' }}</textarea>
                    @error('explenation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn">Versturen</button>
                </div>
            </form>
        </div>
    </div>
</div>