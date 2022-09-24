 <div class="container">
     <div class="row">
         <div class="col left-side">
             <form id="uploadpicture" action="{{ url('/home/uploadpicture') }}" method="POST" enctype="multipart/form-data">
                 @csrf
                 <h1 class="">HOI MEGENSE FOTOGRAAF&<br>SCHRIJVER</h1>
                 <div class="form-group" style="display: none;">
                     <label for="faxonly">
                         <input type="checkbox" name="botTest" id="botTest" />
                     </label>
                 </div>
                 <div class="custom-input custom-file-input">
                     <p>Welke foto's/bestanden wilt u met ons delen?</p>
                     <label for="formFileMultiple" class="form-label">U kunt ook meerdere foto's/bestanden tegelijkertijd uploaden</label>
                     <input required class="form-control custom-file-input @error('file') is-invalid @enderror @error('file.*') is-invalid @enderror" name="file[]" type="file" id="formFileMultiple" multiple>
                     <span id="uploadedFilesMessage" class="d-none">Gekozen bestanden:</span>
                     <span id="maxFilesMessage" class="invalid-feedback d-none" role="alert">
                         <strong>U kunt maximaal 5 bestanden tegelijk aanleveren</strong>
                     </span>
                     <div id="fileList"></div>
                     @error('file')
                     <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                     @error('file.*')
                     <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                 </div>

                 <p>Wilt u dat uw naam bij de foto vermeldt wordt?</p>
                 <div class="form-check showNameButton">
                     <input class="form-check-input" name="showName" type="checkbox" value="1" {{ old('showName') == '1' ? 'checked' : '' }} id="showName">
                     <label class="form-check-label" for="showName">Ja</label>
                 </div>
                 <div class="form-check">
                     <input class="form-check-input" name="showName" type="checkbox" value="0" {{ old('showName') == '0' ? 'checked' : '' }} id="hideName">
                     <label class="form-check-label" for="hideName">Nee</label>
                 </div>
                 @if ($errors->has('showName'))
                 @foreach ($errors->get('showName') as $error)
                 <span class="text-danger" role="alert">
                     <strong>{{ $error }}</strong>
                 </span>
                 @endforeach
                 @endif
                 <div class="authorNameBlock" id="authorNameBlock">
                     <label for="authorName" class="form-label">Naam</label>
                     <input type="name" value="{{ old('name')?? '' }}" name="name" class="form-control @error('name') is-invalid @enderror" id="authorName" placeholder="">
                     @error('name')
                     <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                     </span>
                     @enderror
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