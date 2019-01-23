<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="{{ asset('vendor/eclipse/css/light.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/eclipse/css/pagination.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <title>@yield('title')</title>
  </head>
  <body>
    @include('admin.partials.header')
    @include('admin.partials.sidebar')

    <main>

      @yield('content')
    </main>

    @include('admin.partials.footer')

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('vendor/eclipse/js/materialize.min.js') }}" charset="utf-8"></script>
    <script src="{{ asset('vendor/eclipse/js/app.js') }}" charset="utf-8"></script>
  </body>
</html>
