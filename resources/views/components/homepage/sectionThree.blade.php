<div class="container">
    <div class="row">
        @foreach ($simpleArticles as $simpleArticle)
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{$simpleArticle->title}}</h5>
                    <div class="middle-text">
                        <p class="card-text"> {!! $simpleArticle->information !!}</p>
                    </div>
                    <div class="bottom-button">
                        <a href="{{$simpleArticle->link}}"> <button class="btn btn-outline-dark">Download pdf</button></a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div id="carouselExampleIndicators" class="carousel carousel-dark slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($simpleArticles as $simpleArticle)
            <div class="carousel-item @if ($loop->index === 0) active @endif">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{$simpleArticle->title}}</h5>
                        <div class="middle-text">
                            <p class="card-text"> {!! $simpleArticle->information !!}</p>
                        </div>
                        <div class="bottom-button">
                            <a href="{{$simpleArticle->link}}"> <button class="btn btn-outline-dark">Download pdf</button></a>
                        </div>
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