<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>

    </head>
    <body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <section class="jumbotron py-4">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-11">
                            <h1 class="display-6" style="font-weight: bolder;">Total URL Clicks</h1>
                                <p class="lead">The number of clicks from the shortened URL that redirected the user to the landing page.</p>
                                <div class="mt-4">
                                    <p>Original URL: <span class="bg-white p-2 rounded">{{ $url->original_url }}</span></p>
                                    <p class="mt-4">Shortened URL: <span class="bg-white p-2 rounded"><a href="{{ route('urls.show', $url->short_code) }}">{{ route('urls.show', $url->short_code) }}</a></span></p>
                                    <p><span class="display-6 bg-white py-1 px-4" style="font-weight: bolder;">{{ $url->clicks }}</span></p>
                                    <a href="{{url('/')}}" class="btn btn-primary">Shorten Another URL</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="bg-primary text-white py-5 my-5">
                    <div class="container">
                        <h2 class="text-center mb-4">Why Use URL Shortener?</h2>
                        <p class="lead text-center">URL Shortener offers the following benefits:</p>
                        <ul class="list-group list-group-flush text-center">
                            <li class="list-group-item">Shorten long and complex URLs</li>
                            <li class="list-group-item">Track click statistics for shortened URLs</li>
                            <li class="list-group-item">Improve link sharing on social media platforms</li>
                            <li class="list-group-item">Enhance user experience by reducing URL length</li>
                        </ul>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
        <p>&copy; 2023 URL Shortener. All rights reserved.</p>
        </div>
    </footer>
        @vite('resources/js/app.js')
    </body>
</html>