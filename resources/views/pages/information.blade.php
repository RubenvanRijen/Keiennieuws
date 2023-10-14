@extends('layouts.app')

@section('content')
<div class="informationPage">
    <div class="container-fluid">
        <div class="row">
            <div class="col left-column">
                <div style="max-width: 35rem;">
                    <h1>INFORMATIE</h1>
                    <p>Het Keiennieuws is een dorpsblad wat in ... is opgericht, en heeft een variatie aan artikelen wat over
                        Megen en zijn bewoners gaat. </p>
                    <p>Het is een blad wat in zwart, wit gedrukt wordt en in elkaar gezet wordt door vrijwilligers. </p>
                    <p>Naast de vaste rubrieken heeft het Keiennieuws ruimte voor adverteerders en andere kopij leveranciers
                        om hun publicatie te plaatsen. Via de website kunt u heel gemakkelijk uw plek alvast reserveren zowel
                        als uw publicatie aanleveren.
                    </p>
                </div>
            </div>
            <div class="col middle-column">
                <div style="max-width: 35rem;">
                    <h4>Reserveren</h4>
                    <p>Als u een schrijver bent van een vaste rubrlek, dan hoeft u hiervoor geen plaats te reserveren.
                        Hier is al automatisch rekening mee gehouden. Wanneer u een plek reserveert heeft u voorrang
                        om in het blad te komen. </p>
                    <h4>Advertentiekosten</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Papier formaat</th>
                                <th scope="col">exacte maten</th>
                                <th scope="col">Kosten</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($simpleprices != null && count($simpleprices) > 4)

                            @foreach ($simpleprices as $simplePrice)
                            <tr>
                                <th scope="row">{{$simplePrice->title}}</th>
                                <td>{{$simplePrice->information}}</td>
                                <td>{{$simplePrice->link}},-</td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <th scope="row">A4</th>
                                <td>21 x 29,70 cm</td>
                                <td>19,-</td>
                            </tr>
                            <tr>
                                <th scope="row">A5</th>
                                <td>14,80 x 21 cm</td>
                                <td>12.75,-</td>
                            </tr>
                            <tr>
                                <th scope="row">A6</th>
                                <td>10,50 x14,80 cm</td>
                                <td>9.5,-</td>
                            </tr>
                            <tr>
                                <th scope="row">A7</th>
                                <td>7,40 x 10,50 cm</td>
                                <td>5,-</td>
                            </tr>
                            @endif

                        </tbody>
                    </table>
                    <p>Dit zijn de maandelijkse advertentie kosten</p>

                    <h4>Klachten</h4>
                    <p>Heeft u een klacht, dan kunt u dit melden via dit emall adres en wij zullen dan gaan kijken hoe dit opgelost kan worden. </p>
                </div>
            </div>
            <div class="col right-column">
                <div style="max-width: 35rem;">
                    <h4>Publicatie aanleveren</h4>
                    <p>Wij ontvangen graag een pdf of word bestand. u kunt ook een JPG of PNG aanleveren. </p>
                    <p>Wanneer u een word bestand aanlevert, dan zouden wij graag willen weten of wij de opmaak
                        moeten behouden of juist optimaal kunnen opmaken. Bij het aanleveren van uw bestand zouden
                        wij het fijn vinden dat u rekening houd met de formaten die wij aangeven. Wilt u bulten de
                        standaard formaten treden, dan kunt u de afwijkende formaten aan ons doorgeven via dit
                        email adres: .... Wij adviseren u dit op tijd aan ons door te geven. </p>
                    <h4>Abonnement</h4>
                    <p>Je kunt heel gemakkelijk een abonnement bij ons straten zowel als beëindigen. er zitten hieraan geen kosten verbonden. </p>
                    <h4>Vrijwilligerswerk</h4>
                    <p>Het Keiennieuws is altijd opzoek naar mensen die graag een handje mee zouden willen helpen. </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection