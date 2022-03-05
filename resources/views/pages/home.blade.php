@extends('layouts.app')

@section('content')

<div class="section-one">
    @include('components/homepage/sectionOne')
</div>
<div class="section-two">
    @include('components/homepage/sectionTwo')
</div>
<div class="section-three">
    @include('components/homepage/sectionThree')
</div>

@endsection