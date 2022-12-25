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
                    <h2 class="card-title text-white mb-0">Designs</h2>
                    <div class="card-subtitle">Details and geschiedenis</div>
                </div>

            </div>
        </div>
        <div class="card-body p-4">

            <div class="row">
                <div class="col d-flex justify-content-center">
                    <div class="card">
                        <h5 class="card-header">Vrijwligers beheren</h5>
                        <div class="card-body">
                            <p class="card-text">Vrijwiligers toevoegen, wijzigen en verwijderen.</p>
                            <div class="d-flex justify-content-center">
                                <a href="/dashboard/admin/volunteers">
                                    <button value="view" name="action" type="submit" title="Terug" class="btn btn-primary ml-1 mr-1">
                                        <i class="fs-3 bi bi-person-heart"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col d-flex justify-content-center">
                    <div class="card">
                        <h5 class="card-header">Homepagina beheren</h5>
                        <div class="card-body">
                            <p class="card-text">Teksten toevoegen, wijzigen en verwijderen.</p>
                            <div class="d-flex justify-content-center">
                                <a href="/dashboard/admin/design-edit/home-page">
                                    <button value="view" name="action" type="submit" title="Terug" class="btn btn-primary ml-1 mr-1">
                                        <i class="fs-3 bi bi-house-heart"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection