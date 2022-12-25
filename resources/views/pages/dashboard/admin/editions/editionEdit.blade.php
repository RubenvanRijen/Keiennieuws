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
                    <h2 class="card-title text-white mb-0">Editie #{{$edition->id}}</h2>
                    <div class="card-subtitle">Details and geschiedenis</div>
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
        <form class="p-3 ms-2" action="{{ url('/dashboard/admin/edition-edit/'.$edition->id)}}" method="post">
            @method('PATCH') @csrf
            <div class="field_input">
                <label class="form-label ">Titel</label>
                <input id="firstname" type="text" placeholder="Titel" class="form-control  fourth @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $edition->title ?? '' }}" required autocomplete="title" autofocus>
                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="field_input">
                <label class="form-label">Start Datum</label>
                <input id="beginDate" type="date" placeholder="beginDate" class="form-control  fourth @error('beginDate') is-invalid @enderror" name="beginDate" value="{{ old('beginDate') ?? $edition->beginDate ?? '' }}" required autocomplete="beginDate" autofocus>
                @error('beginDate')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="field_input">
                <label class="form-label">Eind Datum</label>
                <input id="endDate" type="date" placeholder="endDate" class="form-control  fourth @error('endDate') is-invalid @enderror" name="endDate" value="{{ old('endDate') ?? $edition->endDate ?? '' }}" required autocomplete="endDate" autofocus>
                @error('endDate')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="field_input">
                <label class="form-label">Start Datum aanleveren/reserveren</label>
                <input id="beginDateUpload" type="date" placeholder="beginDateUpload" class="form-control  fourth @error('beginDateUpload') is-invalid @enderror" name="beginDateUpload" value="{{ old('beginDateUpload') ?? $edition->beginDateUpload ?? '' }}" required autocomplete="beginDateUpload" autofocus>
                @error('beginDateUpload')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="field_input">
                <label class="form-label">Eind Datum aanleveren/reserveren</label>
                <input id="endDateUpload" type="date" placeholder="endDateUpload" class="form-control  fourth @error('endDateUpload') is-invalid @enderror" name="endDateUpload" value="{{ old('endDateUpload') ?? $edition->endDateUpload ?? '' }}" required autocomplete="endDateUpload" autofocus>
                @error('endDateUpload')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="field_input">
                <label class="form-label">Plaats</label>
                <input id="space" type="numer" step="0.001" placeholder="space" class="form-control  fourth @error('space') is-invalid @enderror" name="space" value="{{ old('space') ?? $edition->space ?? '' }}" required autocomplete="space" autofocus>
                @error('space')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="text-end">
                <div class="form_button mt-3">
                    <button type="submit" class="btn btn-primary">Aanpassen</button>
                </div>
            </div>
        </form>
    </div>

    <div class="card card-raised mt-5">
        <div class="card-header bg-primary text-white px-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="me-4">
                    <h2 class="card-title text-white mb-0">Bookingen</h2>
                    <div class="card-subtitle">Details and geschiedenis</div>
                </div>
                <div class="d-flex gap-2">
                    <!-- <a href="#">
                        <button value="view" name="action" type="submit" class="btn btn-primary ml-1 mr-1">
                            <i class="fs-3 bi bi-cloud-download-fill"></i>
                        </button>
                    </a> <a href="#">
                        <button value="view" name="action" type="submit" title="Terug" class="btn btn-primary ml-1 mr-1">
                            <i class="fs-3 bi bi-printer-fill"></i>
                        </button>
                    </a> -->
                </div>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive-lg">
                <table class="table  table-bordered mb-5">
                    <thead>
                        <tr class="table-primary">
                            <th scope="col">#</th>
                            <th scope="col">Titel</th>
                            <th scope="col">Gebruiker</th>
                            <th scope="col">Type</th>
                            <th scope="col">Formaat</th>
                            <th scope="col">Gemaakt op</th>
                            <th scope="col">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $data)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $data->title}}</td>
                            <td><a href="/dashboard/admin/user-info/{{$data->user_id}}">{{$data->user()->get()[0]->firstname}}</a></td>
                            <td>{{$data->type}}</td>
                            <td>{{$data->size}}</td>
                            <td>{{date('d-m-Y', strtotime($data->created_at))}}</td>
                            <td>
                                <a href="/dashboard/admin/booking-info/{{$data->id}}">
                                    <button value="view" name="action" type="submit" class="btn btn-primary ml-1 mr-1">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- Pagination --}}
            <div class="d-flex justify-content-center">
                {!! $bookings->links() !!}
            </div>
        </div>
    </div>
</div>

@endsection