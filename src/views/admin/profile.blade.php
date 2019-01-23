@extends('admin.layouts.app')

@section('title', 'Laravel Eclipse')


@section('content')
  <!---main content----->
  <div class="main">
    <div class="container">
      <div class="row mt-50">
        <h2 class="center"><b>Your Profile</b></h2>
        <br>
        <div class="col s12 m5">
          <div class="card z-depth-2" style="height: 480px !important;">
            <div class="card-image" style="height: 480px !important;">
              @if(!empty($user->image))
                <img src="{{ asset('storage/profile_images/'.$user->image) }}" style="height:100%;" alt="">
              @else
                <img src="{{ asset('vendor/eclipse/img/profile.jpeg') }}" style="height:100%;" alt="">
              @endif
              <span class="card-title"><b>{{ $user->name }}</b></span>
            </div>
          </div>
        </div>
        <div class="profile-container col s12 m5 offset-m1">
          <div class="card z-depth-2" >
            <div class="card-content">
              <form action="/admin/profile/update" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <ul class="collapsible">
                    <li>
                      <div class="collapsible-header"><i class="material-icons">email</i>{{ $user->email }}</div>
                      <div class="collapsible-body">
                        <div class="row">
                          <div class="input-field">
                            <input id="icon_prefix1" type="email" name="email" class="validate" value="{{ $user->email }}">
                            <label for="icon_prefix1">Email Adress</label>
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>

                <div class="row">
                  <ul class="collapsible">
                    <li>
                      <div class="collapsible-header"><i class="material-icons">account_circle</i>{{ $user->name }}</div>
                      <div class="collapsible-body">
                        <div class="row">
                          <div class="input-field">
                            <input id="icon_prefix1" type="text" name="name" class="validate" value="{{ $user->name }}">
                            <label for="icon_prefix1">Name</label>
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>

                <div class="row">
                  <ul class="collapsible">
                    <li>
                      <div class="collapsible-header"><i class="material-icons">photo</i>Profile Picture</div>
                      <div class="collapsible-body">
                        <div class="row">
                          <div class="input-field">
                            @if(!empty($user->image))
                                <input type="file" class="" name="image" value="{{ asset('storage/profile_images/'.$user->image) }}">
                            @else
                              <input type="file" name="image" value="">
                            @endif
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>

                <div class="row">
                  <ul class="collapsible">
                    <li>
                      <div class="collapsible-header"><i class="material-icons">lock</i>Change Password</div>
                      <div class="collapsible-body">
                        <div class="row">
                          <div class="input-field">
                            <input id="icon_prefix" name="oldPassword" type="password" class="validate">
                            <label for="icon_prefix">Old Password</label>
                          </div>
                          <div class="input-field">
                            <input id="icon_prefix2" name="password1" type="password" class="validate">
                            <label for="icon_prefix2">New Password</label>
                          </div>
                          <div class="input-field">
                            <input id="icon_prefix3" name="password2" type="password" class="validate">
                            <label for="icon_prefix3">Verify New Password</label>
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="card-action">
                <button type="submit" class="btn red z-depth-2">Update Profile</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!---/main content----->
@endsection
