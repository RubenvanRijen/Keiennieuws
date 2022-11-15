@extends('layouts.cms')

@section('content')
<div class="container mt-5">
    <div class="card card-raised">
        <div class="card-header bg-primary text-white px-4">

            <div class="d-flex justify-content-between align-items-center">
                <div class="me-4">
                    <h2 class="card-title text-white mb-0">Gebruiker #{{$user->id}}</h2>
                    <div class="card-subtitle">Details and geschiedenis</div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ url()->previous() }}">
                        <button value="view" name="action" type="submit" class="btn btn-primary ml-1 mr-1">
                            <i class="fs-3 bi bi-skip-backward-circle-fill"></i>
                        </button>
                    </a>
                    <a href="#">
                        <button value="view" name="action" type="submit" class="btn btn-primary ml-1 mr-1">
                            <i class="fs-3 bi bi-cloud-download-fill"></i>
                        </button>
                    </a> <a href="#">
                        <button value="view" name="action" type="submit" title="Terug" class="btn btn-primary ml-1 mr-1">
                            <i class="fs-3 bi bi-printer-fill"></i>
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <ul class="list-group list-group-flush text-center">
            <li class="list-group-item">Naam: {{$user->firstname}} {{$user->lastname}}</li>
            <li class="list-group-item">Postcode: {{$user->postcode}}</li>
            <li class="list-group-item">Adres: {{$user->city}} - {{$user->street_name}} {{$user->house_number}} </li>
            <li class="list-group-item">Email: {{$user->email}}</li>
            <li class="list-group-item">Geslacht: {{$user->gender}}</li>
            <li class="list-group-item">Geabonneerd: @if ($user->subscription()->exists()) ja @else nee @endif </li>
            <li class="list-group-item">Gemaakt op: {{date('d-m-Y', strtotime($user->created_at))}}</li>
            <li class="list-group-item">Verandert op: {{date('d-m-Y', strtotime($user->updated_at))}}</li>

        </ul>
    </div>
</div>

@endsection