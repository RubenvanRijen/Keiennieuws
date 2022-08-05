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
<div class="section-four">
    @include('components/homepage/sectionFour')
</div>
<div class="section-five">
    @include('components/homepage/sectionFive')
</div>
<div class="section-six">
    @include('components/homepage/sectionSix')
</div>
<div id="contact-section-seven" class="section-seven">
    @include('components/homepage/sectionSeven')
</div>
@include('components.layouts.footer')
@endsection