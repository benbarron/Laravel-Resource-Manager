<!---side bar------->
<div class="sidebar z-depth-2">
  <ul class="side-nav-bar">
    <li><i class="fas fa-home fa-2x side-nav-icon"></i><a href="/admin/home" class="side-nav-link">Home</a></li>
    <li><i class="fas fa-user-circle side-nav-icon"></i><a href="/admin/profile" class="side-nav-link">Profile</a></li>
    <li><i class="fas fa-users fa-2x side-nav-icon"></i><a href="/admin/users/admins" class="side-nav-link">Users</a></li>
    <li><i class="fas fa-database fa-2x side-nav-icon"></i><a href="/admin/models" class="side-nav-link">Models</a></li>
    <li><i class="far fa-images fa-2x side-nav-icon"></i><a href="/admin/images" class="side-nav-link">Images</a></li>   
    <li><i class="fas fa-file fa-2x side-nav-icon"></i><a href="/documentation" class="side-nav-link">Documentation</a></li>
    <li><i class="fas fa-sign-out-alt fa-2x side-nav-icon"></i><a href="/admin/logout/{{ Auth::user()->id }}" class="side-nav-link">Logout</a></li>
  </ul>
</div>
<!---/side bar------->

<!--- mobile nav ---->
<div class="mobile-nav-bar">
  <ul class="z-depth-2">
    <a href="/admin/home"><i class="fas fa-home side-nav-icon"></i></a>
    <a href="/admin/users/admins"><i class="fas fa-users side-nav-icon"></i></a>
    <a href="/admin/models"><i class="fas fa-database side-nav-icon"></i></a>
    <a href="/admin/logout"><i class="fas fa-sign-out-alt side-nav-icon"></i></a>
  </ul>
</div>
<!---/mobile nav---->
