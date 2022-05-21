<div class="container">
    <div class="row">
        <div class="col left-side">
            <form class="">
                <h1 class="">HOI MEGENSE FOTOGRAAF</h1>
                <div class="custom-input custom-file-input">
                    <p>Welke foto wilt u met ons delen?</p>
                    <label for="formFileMultiple" class="form-label">U kunt ook meerdere foto's tegelijkertijd uploaden</label>
                    <input class="form-control" type="file" id="formFileMultiple" multiple>
                    <span id="uploadedFilesMessage" class="d-none">Gekozen bestanden:</span>
                    <span id="maxFilesMessage" class="invalid-feedback d-none" role="alert">
                        <strong>U kunt maximaal 5 bestanden tegelijk aanleveren</strong>
                    </span>
                    <div id="fileList"></div>
                </div>

                <p>Wilt u dat uw naam bij de foto vermeldt wordt?</p>
                <div class="form-check showNameButton">
                    <input class="form-check-input" type="checkbox" value="" id="showName">
                    <label class="form-check-label" for="showName">Ja</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="hideName" checked>
                    <label class="form-check-label" for="hideName">Nee</label>
                </div>

                <div class="authorNameBlock" id="authorNameBlock">
                    <label for="authorName" class="form-label">Naam</label>
                    <input type="name" class="form-control" id="authorName" placeholder="">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-outline-warning">Uploaden</button>
                </div>
            </form>

        </div>
        <div class="col right-side">
            <img class="img-fluid " loading="lazy" src="{{url('/images/sectionFive.jpeg')}}" alt="Megense toren">
        </div>
    </div>
</div>