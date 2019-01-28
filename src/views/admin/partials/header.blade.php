<header class="l-header">
  <div class="l-header__inner clearfix">
    <div class="c-search">
      <input class="c-search__input u-input" placeholder="Search..." type="text"/>
    </div>
    <div class="header-icons-group">
      <div class="c-header-icon logout"><a href="/admin/logout/{{ Auth::user()->id }}"><i class="fas fa-sign-out-alt"></i></a></div>
    </div>
  </div>
</header>