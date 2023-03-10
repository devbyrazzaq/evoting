<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        {{-- <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" /> --}}
        {{-- <link rel="stylesheet" href="{{ asset('/css/filepond.css') }}"> --}}

        <!-- Scripts -->
        @vite(['resources/js/app.js'])
        @spladeHead
    </head>
    <body class="font-sans antialiased">
        @splade
        {{-- <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script> --}}
        {{-- <script src="{{ asset('/js/filepond.js') }}"></script> --}}

        
    </body>
</html>
