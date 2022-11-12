@extends('layouts.cms')

@section('content')
<div class="container mt-5">
    <div class="table-responsive-lg">
        <table class="table  table-bordered mb-5">
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
@endsection