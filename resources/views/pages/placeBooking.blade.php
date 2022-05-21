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
                    @if(session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session()->get('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col">
                            <div class="custom-inputfields-width">
                                <label>Voor welke editie wilt u een plek<br> reserveren?</label>
                                <p>Wult u dezelfde publicatie voor langere tijd plaatsen? Selecteer meerdere edities.</p>
                                <div class="custom-input editions-select" style="margin-top: 1.5rem;">
                                    <select required name="edition[]" multiple multiselect-max-items="7" multiselect-search="true" multiselect-select-all="true" id="edition" class="form-control mt-1 select-checkbox-fa @error('edition') is-invalid @enderror">
                                        @foreach ($editions as $edition)
                                        <option value="{{$edition->id}}" {{ (collect(old('edition'))->contains($edition->id)) ? 'selected':'' }}>{{$edition->title}}</option>
                                        @endforeach
                                    </select>
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
                            </div>
                        </div>
                        <!-- <div class="col-2"></div> -->
                        <div class="col">
                            <div class="custom-inputfields-width">
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
                                <div class="custom-input">
                                    <label for="emailadres" class="form-label">Emailadres: </label>
                                    <input required value="{{ old('email')?? $user->email?? '' }}" class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" aria-describedby="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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