@extends('admin.layouts.app')

@section('page-title', 'User Profile')

@section('page-header', 'User Profile')

@section('sidebar')
<div class="logo">
  <div class="logo__txt"><i class="fab fa-laravel"></i></div>
</div>
<div class="l-sidebar__content">
  <nav class="c-menu js-menu">
    <ul class="u-list">
      <a href="/admin/home">
        <li class="c-menu__item" data-toggle="tooltip" title="Flights">
          <div class="c-menu__item__inner">
            <i class="fa fa-home"></i>
            <div class="c-menu-item__title"><span>Home</span></div>
          </div>
        </li>
      </a>
      <a href="/admin/profile">
        <li class="c-menu__item  " data-toggle="tooltip" title="Statistics">
          <div class="c-menu__item__inner">
            <i class="fa fa-user"></i>
            <div class="c-menu-item__title"><span>Profile</span></div>
          </div>
        </li>
      </a>
      <a href="/admin/users/all?view=all">
        <li class="c-menu__item has-submenu is-active" data-toggle="tooltip" title="Gifts">
          <div class="c-menu__item__inner">
            <i class="fa fa-users"></i>
            <div class="c-menu-item__title"><span>Users</span></div>
          </div>
        </li>
      </a>
      <a href="/admin/models">
        <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Settings">
          <div class="c-menu__item__inner">
            <i class="fa fa-database"></i>
            <div class="c-menu-item__title"><span>Models</span></div>
          </div>
        </li>
      </a>
      <a href="/admin/media">
        <li class="c-menu__item" data-toggle="tooltip" title="Settings">
          <div class="c-menu__item__inner">
            <i class="fas fa-images"></i>
            <div class="c-menu-item__title"><span>Media</span></div>
          </div>
        </li>
      </a>
      <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Settings">
        <div class="c-menu__item__inner">
          <i class="fa fa-cogs"></i>
          <div class="c-menu-item__title"><span>Settings</span></div>
        </div>
      </li>
    </ul>
  </nav>
</div>
@endsection

@section('content')
<div class="row">
  @include('admin.partials.alerts')
</div>
<div class="row justify-content-start">
  <div class="col-sm-12">
    <form method="POST" action="/admin/create/user">
      @csrf
      <div class="form-group">
        <label for="">Full Name</label>
        <input type="text" name="name" id="" placeholder="Fullname" class="form-control rounded-0" value="{{ old('name') }}">
      </div>
      <div class="form-group">
        <label for="">Email</label>
        <input type="text" name="email" id="" placeholder="Email" class="form-control rounded-0" value="{{ old('email') }}">
      </div>
      @php
      if(isset($_GET['error']) && $_GET['error'] == "email_taken"){
      echo "<span style='color:#aa0000;'>The email address you entered is already in use</span><br>";
      }
      @endphp
      <div class="form-group">
        <label for="">Password</label>
        <input type="password" name="password1" id="" placeholder="Password" class="form-control rounded-0">
      </div>
      <div class="form-group">
        <label for="">Verify Password</label>
        <input type="password" name="password2" id="" placeholder="Verify Password" class="form-control rounded-0">
      </div>
      @php
      if(isset($_GET['error']) && $_GET['error'] == "password_match"){
      echo "<span style='color:#aa0000;'>The passwords you entered do not match</span><br>";
      }
      @endphp
      <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" name="user_type" id="customSwitch1">
        <label class="custom-control-label" for="customSwitch1">Administrator</label>
      </div>
      <button type="submit" class="btn btn-primary rounded-0 z-depth-1 mt-30">Add User</button>
    </form>
  </div>
</div>
@endsection