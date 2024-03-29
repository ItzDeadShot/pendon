<!-- resources/views/errors/403.blade.php -->

@extends('layout.master2')

@section('content')
    <div class="page-content d-flex align-items-center justify-content-center">
        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto d-flex flex-column align-items-center">
                <img src="{{ url('assets/images/404.svg') }}" class="img-fluid mb-2" alt="403">
                <h1 class="font-weight-bold mb-22 mt-2 tx-80 text-muted">401</h1>
                <h4 class="mb-2">Unauthorized</h4>
                <h6 class="text-muted mb-3 text-center">Oopps!! You are not verified to access this page.</h6>
                <h6 class="text-muted mb-3 text-center">Please <a href="mailto:admin@pendon.com" class="font-bold" style="color: #FFFFFF;">contact</a> the admin.</h6>
                <a href="{{ url('/') }}" class="btn btn-primary">Back to home</a>
            </div>
        </div>
    </div>
@endsection
