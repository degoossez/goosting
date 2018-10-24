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
    <body class="background-blog">
        <div class="flex-center position-ref full-height background-blog">
            <!-- Include the default navbar -->
            @include('layouts.navbar')

            <header>
                    <div class="header__bg background-blog"></div>
                    <h1>Goosting</h1>
                    <h2>Want to earn money writing a blog, article, guide or anything else?</h2>
                    <div class="row">
                        <div class="col-12 text-center">
                            <!-- <button class="button-gradiant-red">Start for free!</button> -->
                            <form action="{{ route('register') }}">
                                <input type="submit" class="btn button-gradiant-red" value="Start for free!" />
                            </form>
                        </div>
                    </div>
            </header>
            <div class="container overlap-top">
                <div class="card-deck mb-3 text-center">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header background-blue">
                            <h4 class="my-0 font-weight-normal">WRITE</h4>
                        </div>
                        <div class="card-body">
                                <h1 class="card-title pricing-card-title">Easy interface</h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>Write a blog, article, guide,</li>
                                <li>poetry or anything else!</li>
                                <li>It's super easy with our</li>
                                <li>user interface!</li>
                            </ul>
                            <button type="button" class="btn btn-lg btn-block button-gradiant-red">Have a look</button>
                        </div>
                    </div>
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header background-blue">
                            <h4 class="my-0 font-weight-normal">PUBLISH</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">Free publishing</h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>You can publish wherever,</li>
                                <li>and whenever you want.</li>
                                <li>Our service is easy to </li>
                                <li>access on any device!</li>
                            </ul>
                            <button type="button" class="btn btn-lg btn-block button-gradiant-red">Browse articles</button>
                        </div>
                    </div>
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header background-blue">
                            <h4 class="my-0 font-weight-normal">PROFIT</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">Earn now</h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>Once published, </li>
                                <li>your content will earn </li>
                                <li>you money from the start </li>
                                <li>using Google Adsense!</li>
                            </ul>
                            <form action="{{ route('register') }}">
                                <input type="submit" class="btn btn-lg btn-block button-gradiant-red" value="Start for free" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <section>

            </section>
        </div>
    </body>
</html>