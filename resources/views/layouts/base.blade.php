<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    @yield('style')
    <title>airB&B</title>
</head>
<body>
  <div id="app">
    <header>

        @include('components.navbar')

    </header>

    <main>

        @yield('head')
        @yield('main')
        @yield('sponsorApt')
        @yield('statistics')
        @yield('search')
    </main>

    <footer>

        @include('components.footer')

    </footer>

    @include('components.login')
    @include('components.register')
  </div>

  @yield('script')
  <script src="{{ mix('js/dropdown.js')}}"></script>
  <script src="{{ mix('js/modal.js')}}"></script>



</body>
</html>
