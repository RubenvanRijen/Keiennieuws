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
                    <h2 class="card-title text-white mb-0">Nieuwe editie</h2>
                    <div class="card-subtitle">Aanmaken and details</div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ url()->previous() }}">
                        <button value="view" name="action" type="submit" class="btn btn-primary ml-1 mr-1">
                            <i class="fs-3 bi bi-skip-backward-circle-fill"></i>
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <form class="p-3 ms-2" action="{{ url('/dashboard/admin/edition-add')}}" method="post">
            @method('POST') @csrf
            <div class="field_input">
                <label class="form-label ">Titel</label>
                <input id="firstname" type="text" placeholder="Titel" class="form-control  fourth @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? '' }}" required autocomplete="title" autofocus>
                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="field_input">
                <label class="form-label">Start Datum</label>
                <input id="beginDate" type="date" placeholder="beginDate" class="form-control  fourth @error('beginDate') is-invalid @enderror" name="beginDate" value="{{ old('beginDate') ?? '' }}" required autocomplete="beginDate" autofocus>
                @error('beginDate')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="field_input">
                <label class="form-label">Eind Datum</label>
                <input id="endDate" type="date" placeholder="endDate" class="form-control  fourth @error('endDate') is-invalid @enderror" name="endDate" value="{{ old('endDate')?? '' }}" required autocomplete="endDate" autofocus>
                @error('endDate')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="field_input">
                <label class="form-label">Start Datum aanleveren/reserveren</label>
                <input id="beginDateUpload" type="date" placeholder="beginDateUpload" class="form-control  fourth @error('beginDateUpload') is-invalid @enderror" name="beginDateUpload" value="{{ old('beginDateUpload')  ?? '' }}" required autocomplete="beginDateUpload" autofocus>
                @error('beginDateUpload')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="field_input">
                <label class="form-label">Eind Datum aanleveren/reserveren</label>
                <input id="endDateUpload" type="date" placeholder="endDateUpload" class="form-control  fourth @error('endDateUpload') is-invalid @enderror" name="endDateUpload" value="{{ old('endDateUpload') ?? '' }}" required autocomplete="endDateUpload" autofocus>
                @error('endDateUpload')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="field_input">
                <label class="form-label">Plaats</label>
                <input id="space" type="numer" step="0.001" placeholder="space" class="form-control  fourth @error('space') is-invalid @enderror" name="space" value="{{ old('space') ?? '' }}" required autocomplete="space" autofocus>
                @error('space')
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