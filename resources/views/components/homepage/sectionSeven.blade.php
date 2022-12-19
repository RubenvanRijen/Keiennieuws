<div class="container">
    <div class="splide">
        <div class="splide__track">
            <ul class="splide__list">
                @foreach ($volunteers as $volunteer)
                <li class="splide__slide">
                    <div class="card">
                        <img src="{{url($volunteerImages[$loop->index])}}" alt="Image" onerror="this.src=" {{ asset('images/profile2.JPEG') }}" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">{{$volunteer->name}}</h5>
                            <p class="card-text">{{$volunteer->information}}</p>
                            <p class="card-text">{{$volunteer->email}}</p>
                            <br>
                            <p class="card-text">Mob: {{$volunteer->phoneNumber}}</p>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>