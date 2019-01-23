<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">


    <link rel="stylesheet" href="{{ asset('vendor/eclipse/css/light.css') }}">

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <title>@yield('title')</title>
  </head>
  <body id="home-page">
    <style media="screen">
      body{
        overflow: hidden !important;
      }
      header{
        background: rgba(10,10,10,0.5) !important;
      }



      header .top-left{
        width: 500px !important;
      }
      .sidebar{
        border-right: #222 3px solid;
        background: rgba(10,10,10,0.5) !important;
      }
    </style>
    <!---top header------>
    <header>
      <div class="top-bar">
        <div class="top-left">
          <h3 class="text-white" style="font-size: 40px;"><b>LaravelEclipse</b></h3>
        </div>
      </div>
    </header>
    <!---/top header------>

    <div class="sidebar">
      <ul class="side-nav-bar">
        <li onclick="window.location.href='https://www.github.com/ben7barron'"><i class="fab fa-github fa-4x side-nav-icon"></i></li>
        <li onclick="window.location.href='https://www.github.com/ben7barron'"><i class="fab fa-bitbucket fa-4x side-nav-icon"></i></li>
      </ul>
    </div>

    <main class="brand-page">
      @include('admin.partials.preload')
      <div class="main">
        <div class="container-fluid">
          <div class="row">
          </div>
        </div>
      </div>

    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('assets/js/materialize.min.js') }}" charset="utf-8"></script>
    <script type="text/javascript">
      $('document').ready(function(){
        setTimeout(
          function(){
              $('.preloader-wrapper').removeClass('active');
              $('.left-panel').addClass('clear');
              $('.right-panel').addClass('clear');
          }, 300);
      });
    </script>
  </body>
</html>
