@extends('layouts.cms')

@section('content')
<div class="container mt-5">
    @if(session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session()->get('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session()->get('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="card card-raised">
        <div class="card-header bg-primary text-white px-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="me-4">
                    <h2 class="card-title text-white mb-0">Vrijwiliger</h2>
                    <div class="card-subtitle">Details and aanmaken</div>
                </div>
            </div>
        </div>
        <form class="p-3 ms-2" action="{{ url('/dashboard/admin/volunteer-add')}}" method="post" enctype="multipart/form-data">
            @method('POST') @csrf
            <div class="field_input">
                <label class="form-label ">Naam</label>
                <input id="name" type="text" placeholder="Naam" class="form-control  fourth @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? '' }}" required autocomplete="name" autofocus>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="field_input">
                <label class="form-label">E-mail</label>
                <input id="email" type="text" placeholder="E-mail" class="form-control  fourth @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? '' }}" required autocomplete="beginDate" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="field_input">
                <label class="form-label">Telefoonnummer</label>
                <input id="phoneNumber" type="text" placeholder="telefoonnummer" class="form-control  fourth @error('phoneNumber') is-invalid @enderror" name="phoneNumber" value="{{ old('phoneNumber')?? '' }}" required autocomplete="phoneNumber" autofocus>
                @error('phoneNumber')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="field_input">
                <label class="form-label">Tonen op de hoofdpagina</label>
                <select name="top" id="top" required class="form-control @error('top') is-invalid @enderror">
                    <option value="1">Ja</option>
                    <option value="0">Nee</option>
                </select>
                @error('top')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div class="field_input">
                <label class="form-label" id="file-Label" for="file">Kies de bestanden die u wilt aanleveren</label>
                <input required type="file" class="form-control custom-file-input @error('file') is-invalid @enderror" id="file" name="file" accept="image/x-png,image/gif,image/jpeg">
                @error('file')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="field_input">
                <label for="information">Informatie</label>
                <textarea class="form-control @error('information') is-invalid @enderror" name="information" id="information" rows="10"> {{ old('information') ?? "" }}</textarea>
                @error('information')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="text-end">
                <div class="form_button mt-3">
                    <button type="submit" class="btn btn-primary">Aanmaken</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection