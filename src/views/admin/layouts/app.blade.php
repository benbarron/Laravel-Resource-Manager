<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/eclipse/css/app.css') }}">
  

  <title>@yield('page-title')</title>
</head>
<body class="sidebar-is-reduced">
  @include('admin.partials.header')
  <div class="l-sidebar">
      @yield('sidebar')
  </div>

  <main class="l-main">
    <div class="content-wrapper content-wrapper--with-bg">
      <h1 class="page-title">@yield('page-header')</h1>
      <div class="page-content">
        <div class="row">
          <div class="col-md-12">
          @yield('content')
          </div>
        </div>
      </div>
    </div>
  </main>


  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
  <script src='https://use.fontawesome.com/2188c74ac9.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>

  <script src="{{ asset('/vendor/eclipse/js/main.js') }}"></script>

  @yield('js')
</html>