@extends('admin.layouts.app')

@section('page-title', 'Users')

@section('page-header', 'Users')

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
      <a href="/admin/users/all?view=all ">
        <li class="c-menu__item is-active" data-toggle="tooltip" title="Gifts">
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
  <div class="row">
              
      <div class="col-md-3">
          <a href="/admin/new/user" class="btn btn-primary mb-30 z-depth-1 rounded-0">New User</a>         
          <ul class="nav nav-tabs" >

            <li class="nav-item">
              <a class="nav-link  rounded-0" href="/admin/users/all?view=all">All Users</a>
            </li>
            <li class="nav-item">
              <a class="nav-link rounded-0" href="/admin/users/admins?view=admins">Admins</a>
            </li>
            <li class="nav-item">
              <a class="nav-link rounded-0 " href="/admin/users/non-admins?view=non-admins">Non Admins</a>
          </li>  

        </ul>
      </div>
      <div class="col-md-9">
        <ul class="nav justify-content-end">
          <li class="nav-item">
            <form class="form-inline">    
              <div class="form-group mx-sm-3 mb-2">
                <input type="text" class="form-control rounded-0" id="" placeholder="Search Users...">
              </div>
              <button type="submit" class="btn btn-primary mb-2 rounded-0 z-depth-1">Enter</button>
            </form>
          </li>
        </ul>
      
      </div>
       
    </div>
    <br>
    <div class="row">
      <br>
      <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">User Type</th>
            </tr>
          </thead>
          <tbody>
            @php $i = 1 @endphp
            @foreach($users as $user)
            <tr>
              <th scope="row">{{ $i }}</th>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              @if($user->IsAdmin == 1)
                <td>Administrator</td>
              @else 
                <td>Normal User</td>
              @endif
              
            </tr>
            @php $i++; @endphp
            @endforeach
          </tbody>
        </table>
      </div>
      <br>
      <div class="row">
          {{ $users->links() }}
      </div>
@endsection