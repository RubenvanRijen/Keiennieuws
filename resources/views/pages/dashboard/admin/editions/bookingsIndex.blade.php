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
                            <th scope="col">Gebruiker</th>
                            <th scope="col">Start datum </th>
                            <th scope="col">Eind Datum</th>
                            <th scope="col">Upload start</th>
                            <th scope="col">Upload eind</th>
                            <th scope="col">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $data)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $data->title}}</td>
                            <td><a href="/dashboard/admin/user-info/{{$data->user_id}}">{{$data->user()->get()[0]->firstname}}</a></td>
                            <td>{{date('d-m-Y', strtotime($data->beginDate))}}</td>
                            <td>{{date('d-m-Y', strtotime($data->endDate))}}</td>
                            <td>{{date('d-m-Y', strtotime($data->beginDateUpload))}}</td>
                            <td>{{date('d-m-Y', strtotime($data->endDateUpload))}}</td>
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