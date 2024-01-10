<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
{{--        @vite(['resources/css/app.css', 'resources/js/app.js'])--}}

{{--        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />--}}
        <!-- common css -->
        <link href="{{ asset('css/landing.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/tail.css') }}" rel="stylesheet" />
        <!-- end common css -->
        @stack('style')
    </head>
    <body>
        <!-- navigation -->
        <header>
            @include('layouts.navigation')
        </header>

        <!-- Page Content -->
        {{ $slot }}
        <!-- footer -->
        @include('layouts.footer')

        <!-- base js -->
        <script src="{{ asset('js/app.js') }}"></script>

        <!-- plugin js -->
        @stack('plugin-scripts')
        <!-- end plugin js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

        @stack('custom-scripts')
    </body>
</html>
