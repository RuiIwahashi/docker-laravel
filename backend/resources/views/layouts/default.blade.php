<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <body>
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>R_BLOG</title>
            <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
            <title>
            @section('title')
            @show
            : bnote
        </title>
        </head>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>