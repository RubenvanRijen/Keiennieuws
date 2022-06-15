<div class="container">
    <div class="row">
        <div class="col left-side">
            <h1>HET KN IS OPZOEK<br> NAAR MEER HANDEN</h1>
            <div>
                <p>3 uurtjes per maand de tijd?</p>
                <p>interesse in lokale nieuwstje?</p>
                <p>zin om te schrijven?</p>
                <p>een enthousiaste persoonlijkheid?</p>
            </div>
        </div>

        <div class="col right-side">
            <form id="" action="{{ url('/home/volunteerapplication') }}" method="POST">
                @csrf
                <div class="form-group" style="display: none;">
                    <label for="faxonly">
                        <input type="checkbox" name="botTest" id="botTest" />
                    </label>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Naam:</label>
                    <input required type="text" name="name" class="form-control" id="name" aria-describedby="name">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Uw emailadres: </label>
                    <input required type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Wat is uw reden tot aanmelding?</label>
                    <textarea required name="explenation" class="form-control" maxlength="300" id="explenation" rows="3"></textarea>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-outline-info">Versturen</button>
                </div>
            </form>
        </div>
    </div>
</div>