<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" >
    <link rel="stylesheet" href="{{ asset('vendor/eclipse/css/app.css') }}">

    <title>Admin Login</title>
  </head>
  <body id="login-page">
    <main>
      <div class="login-form z-depth-2">
        <h3 class="text-center"><b>Laravel Eclipse</b></h3>
        <br>
        <form action="/admin/login" method="post">
          @csrf
          <div class="form-group">
            <input type="email" name="email" id="" class="form-control rounded-0" placeholder="Email" value="{{ old('email') }}">
          </div>
          <div class="form-group">
            <input type="password" name="password" id="" class="form-control rounded-0" placeholder="Password" >
          </div>
          @php
          if(isset($_GET['error']) && $_GET['error'] == "credintials") {
          echo "<span style='color:#aa0000;margin-bottom:50px'>Invalid username or password</span><br>";
          echo "<br>";
          }
          @endphp
          <div class="form-group">
            <button type="submit" class="btn btn-primary rounded-0 z-depth-1 m-auto">Login</button>
          </div>
        </form>
      </div>
    </main>
    
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
    <script src='https://use.fontawesome.com/2188c74ac9.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
    <script src="{{ asset('/vendor/eclipse/js/main.js') }}"></script>    
  </body>
</html>