@extends('layouts.cms')

@section('content')
<div class="container mt-5">
    @if(session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session()->get('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session()->get('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="card card-raised">
        <div class="card-header bg-primary text-white px-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="me-4">
                    <h2 class="card-title text-white mb-0">Hoofdpagina Blokje #{{$simpleHtml->id}}</h2>
                    <div class="card-subtitle">Details and geschiedenis</div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ url()->previous() }}">
                        <button value="view" name="action" type="submit" class="btn btn-primary ml-1 mr-1">
                            <i class="fs-3 bi bi-skip-backward-circle-fill"></i>
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <form class="p-3 ms-2" action="{{ url('/dashboard/admin/design-edit/home-page/simple-edit/'.$simpleHtml->id)}}" method="post" enctype="multipart/form-data">
            @method('PATCH') @csrf
            <div class="field_input">
                <label class="form-label ">Titel</label>
                <input id="name" type="text" placeholder="Titel" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title')?? $simpleHtml->title ?? '' }}" required autocomplete="title" autofocus>
                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="field_input">
                <label class="form-label">Link</label>
                <input id="name" type="text" placeholder="Titel" class="form-control @error('link') is-invalid @enderror" name="link" value="{{ old('link')?? $simpleHtml->link ?? '' }}" autocomplete="title" autofocus>
                @error('link')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="field_input">
                <label class="form-label">Link</label>
                <textarea id="editor" placeholder="informatie" class="form-control @error('information') is-invalid @enderror" name="information" value="{{ old('information')?? $simpleHtml->information ?? '' }}" autocomplete="information" autofocus>
                {{$simpleHtml->information}}
                </textarea>
                @error('information')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="text-end">
                <div class="form_button mt-3">
                    <button type="submit" class="btn btn-primary">Aanpassen</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>
@endsection