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
                @foreach($bookings as $data)
                <tr>
                    <th scope="row">{{ $loop->index + 1 }}</th>
                    <td>{{ $data->title }}</td>
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
@endsection