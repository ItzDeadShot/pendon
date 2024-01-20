@extends('layout.master2')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <div class="page-content d-flex align-items-center justify-content-center">
        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto">
                <div class="card">
                    <div class="row">
                        <div class="col-md-4 pr-md-0">
                            <div class="auth-left-wrapper" style="background-image: url({{ asset('/images/auth/donation-login.jpg') }})">

                            </div>
                        </div>
                        <div class="col-md-8 pl-md-0">
                            <div class="auth-form-wrapper px-4 py-5">
                                <a href="{{ route("/") }}" class="noble-ui-logo logo-light d-block mb-2">Pen<span>Don</span></a>
                                <h5 class="text-muted font-weight-normal mb-4">Create a free account.</h5>
                                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                    @csrf

                                    <!-- Name -->
                                    <div>
                                        <x-input-label for="name" :value="__('Name')" />
                                        <x-text-input id="name"
                                                      class="form-control"
                                                      type="text"
                                                      name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Name"/>
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>

                                    <!-- Email Address -->
                                    <div class="mt-3">
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email"
                                                      class="form-control"
                                                      type="email"
                                                      name="email" :value="old('email')" required autocomplete="username" placeholder="Email"/>
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <!-- Password -->
                                    <div class="mt-3">
                                        <x-input-label for="password" :value="__('Password')" />

                                        <x-text-input id="password" class="form-control"
                                                      type="password"
                                                      name="password"
                                                      required autocomplete="new-password" placeholder="Password"/>

                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="mt-3">
                                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                                        <x-text-input id="password_confirmation" class="form-control"
                                                      type="password"
                                                      name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password"/>

                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>

                                    <!-- ID -->
                                    <div class="stretch-card mt-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h6 class="card-title">Upload ID Proof</h6>
                                                <input type="file" id="myDropify" name="image" class="border" required/>
                                            </div>
                                        </div>
                                    </div>

                                    <x-primary-button class="mt-3">
                                        {{ __('Register') }}
                                    </x-primary-button>
                                    <a href="{{ route('login') }}" class="d-block mt-3 text-muted">Already a user? Sign in</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
@endpush

@push("custom-scripts")
    <script src="{{ asset('assets/js/dropify.js') }}"></script>
@endpush
