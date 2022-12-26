@extends('layouts.cms')

@section('content')
<div class="container mt-5">
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
        <ul class="list-group list-group-flush text-center">
            <li class="list-group-item">Titel: {{$simpleHtml->title}} </li>
            <li class="list-group-item">Text: {{$simpleHtml->information}}</li>
            <li class="list-group-item">Link: {{$simpleHtml->link}}</li>
            <li class="list-group-item">Pagina: {{$simpleHtml->page}}</li>
            <li class="list-group-item">Type: {{$simpleHtml->type}}</li>
        </ul>
        <div id="editor">
            <p>This is some sample content.</p>
        </div>
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