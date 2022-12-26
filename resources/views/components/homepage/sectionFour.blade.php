<div class="container">
    <div class="row">
        @foreach ($simpleStatements as $simpleStatement )
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{$simpleStatement->title}}</h5>
                    <p class="card-text"> {!! $simpleStatement->information !!}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div id="carouselExampleIndicators" class="carousel carousel-dark slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($simpleStatements as $simpleStatement )
            <div class="carousel-item active">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{$simpleStatement->title}}</h5>
                        <p class="card-text"> {!! $simpleStatement->information !!}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <button style="display:none" class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button style="display:none" class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>