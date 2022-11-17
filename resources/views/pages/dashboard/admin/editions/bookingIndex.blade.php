@extends('layouts.cms')

@section('content')
<div class="container mt-5">
    <div class="card card-raised">
        <div class="card-header bg-primary text-white px-4">

            <div class="d-flex justify-content-between align-items-center">
                <div class="me-4">
                    <h2 class="card-title text-white mb-0">Booking #{{$booking->id}}</h2>
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
            <li class="list-group-item">Titel: {{$booking->title}}</li>
            <li class="list-group-item">User: <a href="/dashboard/admin/user-info/{{$booking->user_id}}">{{$booking->user()->get()[0]->firstname}}</a></li>
            <li class="list-group-item">Type: {{$booking->type}}</li>
            <li class="list-group-item">Maat: {{$booking->size}}</li>
            <li class="list-group-item">Email: {{$booking->email}}</li>
            <li class="list-group-item">Gemaakt op op: {{date('d-m-Y', strtotime($booking->created_at))}}</li>
            <li class="list-group-item">Verandert op: {{date('d-m-Y', strtotime($booking->updated_at))}}</li>
            <li class="list-group-item">Bestanden: @foreach ($files as $file)

                @endforeach </li>

        </ul>
    </div>

    <table class="table-responsive-xl">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">URL</th>
                <th scope="col">Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach($files as $file)
            <tr>
                <th data-label="#" scope="row">{{$file->id}}</th>
                <td data-label="title">{{$file->title}}</td>
                <td data-label="URL"><a href="{{$file->url}}">Bestand link</a></td>

                <td class="actions text-right d-flex">

                    <a href="{{$links[0]}}">
                        <button value="view" name="action" type="submit" class="btn btn-info ml-1 mr-1">
                            <i class="fas fa-download"></i></button>
                    </a>
                    <form action="{{ url('/cms/files/delete/'.$file->id )}}" method="post" enctype="multipart/form-data">@method('DELETE') @csrf
                        <button value="delete" name="action" type="submit" class="btn btn-danger ml-1 mr-1"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4 text-right p-2 mb-3">
        {{ $files->links() }}
    </div>
</div>

@endsection