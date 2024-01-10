@extends('layout.master2')

@section('content')
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="page-content d-flex align-items-center justify-content-center">
        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto">
                <div class="card">
                    <div class="row">
                        <div class="col-md-4 pr-md-0">
                            <div class="auth-left-wrapper" style="background-image: url({{ asset('images/auth/donation-login.jpg') }})">

                            </div>
                        </div>
                        <div class="col-md-8 pl-md-0">
                            <div class="auth-form-wrapper px-4 py-5">
                                <a href="#" class="noble-ui-logo logo-light d-block mb-2">Pen<span>Don</span></a>
                                <h5 class="text-muted font-weight-normal mb-4">Welcome back! Log in to your account.</h5>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <!-- Email Address -->
                                    <div>
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email"
                                                      class="form-control"
                                                      type="email"
                                                      name="email"
                                                      :value="old('email')" required autofocus autocomplete="username" placeholder="Email"/>
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                    <!-- Password -->
                                    <div class="mt-4">
                                        <x-input-label for="password" :value="__('Password')" />

                                        <x-text-input id="password" class="form-control"
                                                      type="password"
                                                      name="password"
                                                      required autocomplete="current-password" placeholder="Password"/>

                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                    <!-- Remember Me -->
                                    <div class="form-check form-check-flat form-check-primary">
                                        <label for="remember_me" class="form-check-label">
                                            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                            Remember me
                                        </label>
                                    </div>
                                    <x-primary-button class="">
                                        {{ __('Log in') }}
                                    </x-primary-button>
                                    <a href="{{ route('register') }}" class="d-block mt-3 text-muted">Not a user? Sign up</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
