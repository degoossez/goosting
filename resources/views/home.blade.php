<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('layouts.googleincludes')
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ setting('site.title') }}</title>

        <!-- File containing all layout/css/js includes -->
        @include('layouts.includes')
    </head>
    <body class="body-image">

    </body>
</html>
