@extends('layouts.cms')

@section('content')
<div class="container mt-5">
    <div class="card card-raised">
        <div class="card-header bg-primary text-white px-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="me-4">
                    <h2 class="card-title text-white mb-0">Gebruikers</h2>
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
                <table class="table table-bordered mb-5">
                    <thead>
                        <tr class="table-primary">
                            <th scope="col">#</th>
                            <th scope="col">Voornaam</th>
                            <th scope="col">Achternaam</th>
                            <th scope="col">Email </th>
                            <th scope="col">geabonneerd</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $data)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $data->firstname }}</td>
                            <td>{{ $data->lastname }}</td>
                            <td>{{ $data->email }}</td>
                            @if ($data->subscription()->exists())
                            <td> ja </td>
                            @else
                            <td>nee</td>
                            @endif
                            <td>
                                <div class="row">
                                    <div class="col">
                                        <a style="text-decoration: none; color: inherit;" href="/dashboard/admin/user-info/{{$data->id}}">
                                            <button value="view" name="action" type="submit" class="btn btn-primary ml-1 mr-1">
                                                <i class="bi bi-eye-fill"></i>
                                            </button>
                                        </a>
                                        <a style="text-decoration: none; color: inherit;" href="/dashboard/admin/user-info/{{$data->id}}">
                                            <button value="view" name="action" type="submit" class="btn btn-danger ml-1 mr-1">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </a>
                                        <a style="text-decoration: none; color: inherit;" href="/dashboard/admin/user-info/{{$data->id}}">
                                            <button value="view" name="action" type="submit" class="btn btn-success ml-1 mr-1">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- Pagination --}}
            <div class="d-flex justify-content-center">
                {!! $users->links() !!}
            </div>
        </div>
    </div>
</div>

@endsection