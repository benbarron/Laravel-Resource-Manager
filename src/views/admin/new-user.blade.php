@extends('admin.layouts.app')

@section('title', 'Laravel Eclipse')


@section('content')
  <!---main content----->
  <div class="main">
    <div class="container">
      <div class="row">
        <div class="col s10 offset-s1 m10">
          <div class="row section-heading">
            <h2><b>New User</b></h2>
          </div>
          <div class="row">
            <form method="POST" action="/admin/create/user">
              @csrf
              <div class="row">
                <div class="input-field">
                  <i class="material-icons prefix">account_circle</i>
                  <input id="icon_prefix" type="text" name="name" class="validate" value="{{ old('name') }}">
                  <label for="icon_prefix">Full Name</label>

                </div>
              </div>
              <div class="row">
                <div class="input-field">
                  <i class="material-icons prefix">email</i>
                    <input id="icon_prefix1" type="email" name="email" class="validate" value="{{ old('email') }}">
                  <label for="icon_prefix1">Email Adress</label>
                </div>
                  @php
                    if(isset($_GET['error']) && $_GET['error'] == "email_taken"){
                      echo "<span style='color:#aa0000;'>The email address you entered is already in use</span>";
                    }
                  @endphp
              </div>
              <div class="row">
                <div class="input-field">
                  <i class="material-icons prefix">lock</i>
                  <input id="icon_prefix2" type="password" name="password1" class="validate" >
                  <label for="icon_prefix2">Password</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field">
                  <i class="material-icons prefix">lock</i>
                  <input id="icon_prefix3" type="password" name="password2" id="character_count" class="validate" data-length="20">
                  <label for="icon_prefix3">Verify Password</label>
                </div>
                  @php
                    if(isset($_GET['error']) && $_GET['error'] == "password_match"){
                      echo "<span style='color:#aa0000;'>The passwords you entered do not match</span>";
                    }
                  @endphp
              </div>
              <div class="row">
                <div class="input-field">
                  <div class="switch">
                  <label>
                    User
                    <input type="checkbox" name="user_type" id="profile-switch-input">
                    <span class="lever grey" id="profile-switch-lever"></span>
                    Admin
                  </label>
                  </div>
                </div>
              </div>
              <div class="row">
                <button type="submit" class="btn-secondary z-depth-2">Add User</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!---/main content----->

@endsection
