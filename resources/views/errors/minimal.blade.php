<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
</head>

<body>
    <div class="error-container">
        <div class="error">
          <p>Opsss...</p>
                <a href="{{route('home')}}">
                    <img src="{{ asset('img/logo.png') }}" alt="">
                </a>
            <div class="code">
                @yield('code')
            </div>
        </div>
    </div>
</body>

</html>
