<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="{{ asset('vendor/eclipse/css/'.env('stylesheet').'.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <title>Login</title>
  </head>
  <body>
    <style>body{overflow: hidden;}</style>
    <!---top header------>
    <header>
      <div class="top-bar">
        <div class="top-left">
          <h3 id="large-logo"><b>LaravelEclipse</b></h3>
          <h3 class="show" id="small-logo"><i class="fab fa-laravel fa-2x"></i></h3>
        </div>
      </div>
    </header>
    <!---/top header------>


    <main class="login-page">
      @include('admin.partials.preload')
      <div class="login-form z-depth-3">
        <h3 class="center text-white"><b>Laravel Eclipse</b></h3>
        <br>
        <form class="" action="/admin/login" method="post">
          @csrf
          <div class="row">
            <div class="input-field">
              <i class="material-icons prefix">account_circle</i>
              <input id="icon_prefix3" name="email" type="text" id="character_count" class="validate" value="{{ old('email') }}">
             @php
              if(isset($_GET['error'])){
                echo "<label for='icon_prefix3'><span style='color:#aa0000;'>Email</span></label>";
              } else {
                echo "<label for='icon_prefix4'><span style='color:#fff;'>Email</span></label>";
              }
              @endphp
            </div>
          </div>
          <div class="row">
            <div class="input-field">
              <i class="material-icons prefix">lock</i>
              <input id="icon_prefix4" type="password" name="password" id="character_count" class="validate" data-length="20">
               @php
                if(isset($_GET['error'])){
                  echo "<label for='icon_prefix4'><span style='color:#aa0000;'>Password</span></label>";
                } else {
                  echo "<label for='icon_prefix4'><span style='color:#fff;'>Password</span></label>";
                }
                @endphp
            </div>
          </div>
            @php
            if(isset($_GET['error'])){
              echo "<span style='color:#aa0000;''>Invalid Details</span><br>";
            }
            @endphp
          <div class="row mt-20">
            <button type="submit" class="btn-primary z-depth-2">Login</button>
          </div>
        </form>
      </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('vendor/eclipse/js/materialize.min.js') }}" charset="utf-8"></script>

  </body>
</html>
