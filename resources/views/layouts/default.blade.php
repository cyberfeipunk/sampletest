<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title','Sample APP')-中维世纪</title>
    <link rel="stylesheet" href="/css/app.css?x=2">
</head>
<body>
    @include('layouts._header')
    <div class="container">
        <div class="col-md-offset-1 col-md-10">
            @include('shared._message')
            @yield('content')
            @include('layouts._footer')
        </div>

    </div>
</body>
</html>
