@extends('layouts.app')

@section('content')
    <div class="notfound">
        <div class="information">
            <div class="error-code">
                <h1>{{$responseCode ?? 'Error'}}</h1>
            </div>
            <p>{{$responseText2 ?? 'OOPS, er ging iets fout'}}</p>
            <a href="{{url('/home')}}"><span class="arrow"></span>Return To Homepage</a>
        </div>
    </div>
@endsection
