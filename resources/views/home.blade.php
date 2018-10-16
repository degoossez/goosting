<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ setting('site.title') }}</title>

        <!-- File containing all layout/css/js includes -->
        @include('layouts.includes')
    </head>
    <body>
        <div class="flex-center position-ref full-height background-blog">
            <!-- Include the default navbar -->
            @include('layouts.navbar')

            <!-- Test with dummy blog -->
            @include('layouts.dummyblog')
        </div>
    </body>
</html>
