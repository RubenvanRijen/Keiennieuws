@extends('layouts.cms')

@section('content')
<div class="dashboard_users">
    <div class="container">
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
        <h1 class="fadeIn first">Uw Reserveringen/Publicaties</h1>
        <hr class="fadeIn second">
        <div class="booking_publications_overview fadeIn third">
            @if (count($bookings) === 0)
            <h4>U heeft nog geen reserveringen geplaatst</h4>
            @endif
            <div class="row ">
                @foreach ($bookings as $booking )
                <div class="col fadeIn fourth">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">#{{ $loop->index + 1 }} - {{$booking->title}}</h5>
                            <hr>
                            <p class="card-subtitle">Type: {{$booking->type}}</p>
                            <p class="card-subtitle">Groote: {{$booking->size}}</p>
                            <p class="card-subtitle">Gemaakt op: {{$booking->created_at}}</p>
                            <p class="card-subtitle mb-1">Edities:
                                @foreach ($booking->editions()->get() as $edition)
                                {{$edition->title}} ,
                                @endforeach
                            </p>
                            <form action="{{ url('/dashboard/person-reservations/delete/'.$booking->id)}}" id="deleteBookingDashboard" method="post" enctype="multipart/form-data">@method('DELETE') @csrf
                                <button onclick="deleteBooking();" type="sumbit" @if (in_array($booking->id, $allowedBookings)) disabled @endif class="btn btn-outline-danger show_confirm_delete_booking_dashboard">
                                    <i class="bi bi-trash"></i>
                                    Verwijderen
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

</script>
@endsection