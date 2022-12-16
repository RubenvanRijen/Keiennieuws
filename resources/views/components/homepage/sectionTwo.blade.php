<div class="bg-image">
    <div class="content-wrap">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">NOG <span class="number-days">{{$timeDiff}}</span> DAGEN</h5>
                <p class="card-text">Wilt u iets in het Keiennieuws plaatsen? @if ($edition !== null)Dan heeft u tot<br>
                    {{date('d-m-Y', strtotime($edition->endDateUpload))}}
                    de tijd om uw materiaal bij ons aan te leveren voor in de editie van
                    {{$edition->title}} @else er is op het moment nog geen edite beschikbaar @endif . <br> Heeft u uw bestanden al klaar liggen kies dan aanleveren, hebt u dat nog niet kies dan reseveren om dit later te kunnen doen.
                </p>
                <div class="row">
                    <div class="col mt-2">
                        <a href="/placepublication" class=""> <button class="btn btn-outline-success rounded-0">Aanleveren</button></a>
                    </div>
                    <div class="col mt-2">
                        <a href="/placebooking" class=""> <button class="btn btn-outline-success rounded-0"> Reserveren</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>