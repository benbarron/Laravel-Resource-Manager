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
        <li class="c-menu__item  is-active" data-toggle="tooltip" title="Statistics">
          <div class="c-menu__item__inner">
            <i class="fa fa-user"></i>
            <div class="c-menu-item__title"><span>Profile</span></div>
          </div>
        </li>
      </a>
      <a href="/admin/users/all?view=all">
        <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Gifts">
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
  <div class="col-sm-12 col-md-4 col-lg-4 text-center mt-100">
    @if(!empty(Auth::user()->image))
    <img src="{{ asset('storage/profile_images/'.$user->image) }}" style="width:80%;height:80%;">
    @else
    <img src="{{ asset('vendor/eclipse/img/user.png') }}" >
    @endif
  </div>
  <div class="col-sm-12 col-md-6">
    <form action="/admin/profile/update" method="post" enctype="multipart/form-data">
    @csrf
    <div class="input">
      <label for="">Name</label>
      <input type="text" class="form-control rounded-0" name="name" placeholder="name" value="{{ $user->name }}">
    </div>
    <br>
    <div class="input">
      <label for="">Email</label>
      <input type="text" class="form-control rounded-0" name="email" placeholder="email" value="{{ $user->email  }}">
    </div>
    <br>
    <div class="input">
      <label for="">Profile Picture</label>
      <br>
      @if(!empty($user->image))
      <div class="custom-file">
          <input type="file" class="custom-file-input" name="image" id="customFile" value="{{ asset('storage/profile_images/'.$user->image) }}">
          <label class="custom-file-label" for="customFile">{{ $user->image }}</label>
      </div>
      @else
      <div class="custom-file">
          <input type="file" class="custom-file-input" name="image" id="customFile">
          <label class="custom-file-label" for="customFile">Choose file</label>
      </div>
      @endif
    </div>
    <br>
    <div class="input">
      <label for="">Old Password</label>
      <input type="password" class="form-control rounded-0" name="oldPassword" placeholder="Old Password" >
    </div>
    <br>
    <div class="input">
      <label for="">New Password</label>
      <input type="password" class="form-control rounded-0" name="password1" placeholder="New Password">
    </div>
    <br>
    <div class="input">
      <label for="">Verify New Password</label>
      <input type="password" class="form-control rounded-0" name="password2" placeholder="Verify New Password">
    </div>
    <br><br>
    <div class="input">
      <button type="submit" class="btn btn-primary z-depth-2 rounded-0">Update Profile</button>
    </div>
  </div>
</div>
@endsection
