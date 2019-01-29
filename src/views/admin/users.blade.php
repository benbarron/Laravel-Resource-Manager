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

  </div>
  <div class="col-md-9">
    <ul class="nav justify-content-end">
      <li class="nav-item">
        <form class="form-inline">
          <div class="form-group mx-sm-3 mb-2">
            <input type="text" class="form-control rounded-0" id="search-input" placeholder="Search Users...">
          </div>

        </form>
      </li>
    </ul>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <ul class="nav nav-tabs" >
      @php
      if(isset($_GET['view'])) {
        if($_GET['view'] == "all") {
          $view = "all";
        } else if ($_GET['view'] == "admins") {
          $view = "admins";
        } else if ($_GET['view'] == "non-admins") {
          $view = "non-admins";
        }
      }  else {
        $view = "";
      }
      @endphp
      <li class="nav-item">
        <a class="nav-link @php if($view == 'all') echo 'active'; @endphp  rounded-0" href="/admin/users/all?view=all">All Users</a>
      </li>
      <li class="nav-item">
        <a class="nav-link @php if($view == 'admins') echo 'active'; @endphp rounded-0" href="/admin/users/admins?view=admins">Admins</a>
      </li>
      <li class="nav-item">
        <a class="nav-link @php if($view == 'non-admins') echo 'active'; @endphp rounded-0 " href="/admin/users/non-admins?view=non-admins">Non Admins</a>
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
    <tbody id="users-table">
      @if(count($users) > 0)
        @php $i = 1 @endphp
        @php
          $i = 0;
        @endphp
        @foreach($users as $user)
        <tr id="user-{{ $i }}" class="user-count">
          <th scope="row">{{ $i }}</th>
          <td class="users-name">{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          @if($user->IsAdmin == 1)
          <td>Administrator</td>
          @else
          <td>Normal User</td>
          @endif
        </tr>
        @php $i++; @endphp
        @endforeach
      @else
        <tr>
          <td>No Users Found</td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      @endif
    </tbody>
  </table>
</div>
<br>
<div class="row">
  {{ $users->links() }}
</div>
@endsection

@section('js')
<script>
  let filterInput = document.getElementById('search-input');
  filterInput.addEventListener('keyup', filterUsers);
  function filterUsers() {
    let filterValue = document.getElementById('search-input').value.toUpperCase();
    let users = $('.users-name');
    for(let i = 0; i < users.length; i++) {
      if(users[i].innerHTML.toUpperCase().indexOf(filterValue) > -1) {
          users[i].style.display = '';
          document.getElementById('user-'+i).style.display = '';
      } else {
        document.getElementById('user-'+i).style.display = 'none';
      }
    }
  }
</script>
@endsection
