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

        {{-- Bootstrap --}}
        <link rel="stylesheet" href="{{asset('admin/css/bootstrap.min.css')}}">

        {{-- FontAwesome --}}
        <link rel="stylesheet" href="{{asset('admin/fontawesome/fontawesome.min.css')}}">

        {{-- Custom --}}
        <link rel="stylesheet" href="{{asset('home/css/style.css')}}">

    </head>
    <body class="font-sans antialiased">

        {{-- Navbar --}}
        @include('components.home.navbar')

        @yield('content')

        <!--   Core JS Files   -->
        <script src="{{ asset('admin/js/core/jquery-3.7.1.min.js') }}"></script>

        <!-- FontAwesome -->
        <script src="{{ asset('admin/fontawesome/fontawesome.min.js') }}"></script>

        {{-- Bootstrap --}}
        <script src="{{ asset('admin/js/core/bootstrap.min.js') }}"></script>

        {{-- Custom --}}
        <script src="{{ asset('home/js/main.js') }}"></script>
    </body>
</html>
