@extends('admin.layouts.app')
@section('title', 'Laravel Eclipse')
@section('content')
  <!---main content----->
  <div class="main">
    <div class="container">
      <div class="row">
        <nav>
          <div class="nav-wrapper">
            <a href="#" class="brand-logo">Users Table</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
              <li><a href="/admin/users/all">All Users</a></li>
              <li><a href="/admin/users/admins">Admins</a></li>
              <li><a href="/admin/users/non-admins">Non Admins</a></li>
            </ul>
          </div>
        </nav>
      </div>
      <div class="row">
        <!--- users table --->
        <table class="striped highlighted users-table z-depth-2">
          <thead>
            <tr>
              <th>Image</th>
              <th>Name</th>
              <th>Email</th>
              <th>User Type</th>
            </tr>
          </thead>
          <tbody>
            @if(count($users) > 0)
              @foreach($users as $user)
                <tr>
                  <td>
                    @if(!empty($user->image))
                      <img src="{{ asset('storage/profile_images/'.$user->image) }}" style="width: 50px;height:50px;" class="user-img" alt="">
                    @else
                      <img src="{{ asset('vendor/eclipse/img/profile.jpeg') }}" style="width: 50px;height:50px;" class="user-img" alt="">
                    @endif
                  </td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  @if($user->IsAdmin == 1)
                    <td>Adminstrator</td>
                  @else
                    <td>Non Admin</td>
                  @endif
                </tr>
              @endforeach
            @else
            @endif
          </tbody>
        </table>
        <!--- /users table --->
        <div class="row mt-40">
          <a href="/admin/new/user" class="btn red z-depth-2 waves-effect mr-20">Add User</a>
        </div>
      </div>
    </div>
  </div>
  <!---/main content----->
@endsection
