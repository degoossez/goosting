<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ setting('site.title') }}</title>
    
    <!-- File containing all layout/css/js includes -->
    @include('layouts.includes')
</head>
<body>
    <div id="app">
        <!-- Include the default navbar -->
        @include('layouts.navbar')
        @yield('content')
    </div>
</body>
</html>
