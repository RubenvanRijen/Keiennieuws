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
                    <h2 class="card-title text-white mb-0">Hoofdpagina</h2>
                    <div class="card-subtitle">Details and aanpassen</div>
                </div>
                <div class="d-flex gap-2">
                    <a href="/dashboard/admin/design-edit">
                        <button value="view" name="action" type="submit" class="btn btn-primary ml-1 mr-1">
                            <i class="fs-3 bi bi-skip-backward-circle-fill"></i>
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body p-4">
            <h1>Artikelen</h1>
            <div class="d-flex gap-2">
                <div class="row d-flex justify-content-center">
                    @foreach ($simpleArticles as $simpleArticles)
                    <div class="card m-2 text-center" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{$simpleArticles->title}}</h5>
                            <h6 class="card-subtitle mb-4 text-muted">{{$simpleArticles->page}} - {{$simpleArticles->type}}</h6>
                            <p class="card-text">{{$simpleArticles->information}}</p>
                            <a href="#" class="card-link">{{$simpleArticles->link}}</a>

                        </div>
                        <div class="d-flex mb-3 justify-content-center">
                            <a class="ms-1 me-1" style="text-decoration: none; color: inherit;" href="/dashboard/admin/design-edit/home-page/simple-info/{{$simpleArticles->id}}">
                                <button value="view" name="action" type="submit" class="btn btn-primary ml-1 mr-1">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
                            </a>
                            <a class="ms-1 me-1" style="text-decoration: none; color: inherit;" href="/dashboard/admin/design-edit/home-page/simple-edit/{{$simpleArticles->id}}">
                                <button value="view" name="action" type="submit" class="btn btn-success ml-1 mr-1">
                                    <i class="bi bi-pencil-fill"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <hr>
            <h1>Mededelingen</h1>
            <div class="d-flex gap-2">
                <div class="row justify-content-md-center">
                    @foreach ($simpleStatements as $simpleStatement)
                    <div class="card m-2 text-center" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{$simpleStatement->title}}</h5>
                            <h6 class="card-subtitle mb-4 text-muted">{{$simpleStatement->page}} - {{$simpleStatement->type}}</h6>
                            <p class="card-text">{{$simpleStatement->information}}</p>
                            <a href="#" class="card-link">{{$simpleStatement->link}}</a>
                        </div>
                        <div class="d-flex mb-3 justify-content-center">
                            <a class="ms-1 me-1" style="text-decoration: none; color: inherit;" href="/dashboard/admin/design-edit/home-page/simple-info/{{$simpleStatement->id}}">
                                <button value="view" name="action" type="submit" class="btn btn-primary ml-1 mr-1">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
                            </a>
                            <a class="ms-1 me-1" style="text-decoration: none; color: inherit;" href="/dashboard/admin/design-edit/home-page/simple-edit/{{$simpleStatement->id}}">
                                <button value="view" name="action" type="submit" class="btn btn-success ml-1 mr-1">
                                    <i class="bi bi-pencil-fill"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endsection