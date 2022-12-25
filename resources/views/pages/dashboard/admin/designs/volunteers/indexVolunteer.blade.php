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
                    <h2 class="card-title text-white mb-0">Vrijwiliger #{{$volunteer->id}}</h2>
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
        <div class="card-body p-4">
            <div class="grid">
                <div class="row d-flex justify-content-center">
                    <div class="card m-2" style="width: 20rem;">
                        <img src="{{url($image)}}" alt="Image" onerror="this.src=" {{ asset('images/profile2.JPEG') }}" class="card-img-top p-2">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{$volunteer->name}}</h5>
                            <p class="card-text">{{$volunteer->email}}</p>
                            <p class="card-text">Mob: {{$volunteer->phoneNumber}}</p>
                            <div class="d-flex justify-content-center">
                                <a class="ms-1 me-1" style="text-decoration: none; color: inherit;" href="/dashboard/admin/volunteer-edit/{{$volunteer->id}}">
                                    <button value="view" name="action" type="submit" class="btn btn-success ml-1 mr-1">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection