<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Simple laravel project boilerplate that supports docker compose for development environment">
        <meta name="keywords" content="laravel, docker, boilerplate, docker-compose">
        <meta name="author" content="https://github.com/sdarmaputra">
        <meta name="theme-color" content="#f4645f">

        <title>Dockey Laraplate</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Poiret+One|Yesteryear" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Poiret One', cursive, sans-serif;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
                font-family: 'Yesteryear', cursive;
            }

            .secondary-title {
                font-size: 22px;
                width: 400px;
                margin: auto;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                transition: 0.35s all;
                -webkit-transition: 0.35s all;
                -moz-transition: 0.35s all;
            }

            .links > a:hover {
                color: #f4645f;
                text-shadow: 0px 3px 15px #f4645f;
            }

            .m-b-md {
                margin-bottom: 100px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="m-b-md">
                    <div class="title">
                        Dockey Laraplate
                    </div>
                    <div class="secondary-title">
                        Simple laravel project boilerplate that supports docker compose for development environment.<br/>
                        Coding is always be fun :)
                    </div>
                </div>

                <div class="links">
                    <a target="_blank" href="https://laravel.com/docs">Laravel Documentation</a>
                    <a target="_blank" href="https://laracasts.com">Laracasts</a>
                    <a target="_blank" href="https://laravel-news.com">Laravel News</a>
                    <a target="_blank" href="https://forge.laravel.com">Laravel Forge</a>
                    <a target="_blank" href="https://github.com/laravel/laravel">Laravel GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html>
