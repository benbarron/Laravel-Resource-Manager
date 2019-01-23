<!---top header------>
<header class="z-depth-3">
  <div class="top-bar">
    <div class="top-left">
      <h3 id="large-logo"><b>LaravelEclipse</b></h3>
      <h3 class="show" id="small-logo"><i class="fab fa-laravel fa-2x"></i></h3>
    </div>
    <div class="user-info">
      <a href="/admin/profile">
        @if(!empty(Auth::user()->image))
        <img src="{{ asset('storage/profile_images/'.Auth::user()->image) }}" class="user-img z-depth-4" alt="">
        @else
          <img src="{{ asset('vendor/eclipse/img/profile.jpeg') }}" class="user-img z-depth-4" alt="">
        @endif
      </a>
    </div>
  </div>
</header>
<!---/top header------>
