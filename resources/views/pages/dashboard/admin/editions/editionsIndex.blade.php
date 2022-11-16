@extends('layouts.cms')

@section('content')
<div class="container mt-5">
    <div class="card card-raised">
        <div class="card-header bg-primary text-white px-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="me-4">
                    <h2 class="card-title text-white mb-0">Edities</h2>
                    <div class="card-subtitle">Details and geschiedenis</div>
                </div>
                <div class="d-flex gap-2">
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
        <div class="card-body p-4">
            <div class="table-responsive-lg">

                <table class="table  table-bordered mb-5">
                    <thead>
                        <tr class="table-primary">
                            <th scope="col">#</th>
                            <th scope="col">Titel</th>
                            <th scope="col">Totale ruimte</th>
                            <th scope="col">Start datum </th>
                            <th scope="col">Eind Datum</th>
                            <th scope="col">Upload start</th>
                            <th scope="col">Upload eind</th>
                            <th scope="col">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Huidige Editie</th>
                            <td>{{ $currentEdition->title}}</td>
                            <td>{{ $currentEdition->space}}</td>
                            <td>{{date('d-m-Y', strtotime($currentEdition->beginDate))}}</td>
                            <td>{{date('d-m-Y', strtotime($currentEdition->endDate))}}</td>
                            <td>{{date('d-m-Y', strtotime($currentEdition->beginDateUpload))}}</td>
                            <td>{{date('d-m-Y', strtotime($currentEdition->endDateUpload))}}</td>
                            <td>
                                <a href="/dashboard/admin/edition-info/{{$currentEdition->id}}">
                                    <button value="view" name="action" type="submit" class="btn btn-primary ml-1 mr-1">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Volgende Editie</th>
                            <td>{{ $upcomingEdition->title}}</td>
                            <td>{{ $upcomingEdition->space}}</td>
                            <td>{{date('d-m-Y', strtotime($upcomingEdition->beginDate))}}</td>
                            <td>{{date('d-m-Y', strtotime($upcomingEdition->endDate))}}</td>
                            <td>{{date('d-m-Y', strtotime($upcomingEdition->beginDateUpload))}}</td>
                            <td>{{date('d-m-Y', strtotime($upcomingEdition->endDateUpload))}}</td>
                            <td>
                                <a href="/dashboard/admin/edition-info/{{$upcomingEdition->id}}">
                                    <button value="view" name="action" type="submit" class="btn btn-primary ml-1 mr-1">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>


            <div class="table-responsive-lg">
                <table class="table  table-bordered mb-5">
                    <thead>
                        <tr class="table-primary">
                            <th scope="col">#</th>
                            <th scope="col">Titel</th>
                            <th scope="col">Totale ruimte</th>
                            <th scope="col">Start datum </th>
                            <th scope="col">Eind Datum</th>
                            <th scope="col">Upload start</th>
                            <th scope="col">Upload eind</th>
                            <th scope="col">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($editions as $data)
                        <tr @if ( $currentEdition->id === $data->id) class="table-success" @elseif ($upcomingEdition->id === $data->id)class="table-info" @endif>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $data->title}}</td>
                            <td>{{ $data->space}}</td>
                            <td>{{date('d-m-Y', strtotime($data->beginDate))}}</td>
                            <td>{{date('d-m-Y', strtotime($data->endDate))}}</td>
                            <td>{{date('d-m-Y', strtotime($data->beginDateUpload))}}</td>
                            <td>{{date('d-m-Y', strtotime($data->endDateUpload))}}</td>
                            <td>
                                <a href="/dashboard/admin/edition-info/{{$data->id}}">
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
                {!! $editions->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection