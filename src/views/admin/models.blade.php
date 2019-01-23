@extends('admin.layouts.app')

@section('title', 'Laravel Eclipse')

@section('content')
  <!---main content----->
  <div class="main">
    <div class="container">
      <div class="row">
        @include('admin.alerts.messages')
      </div>
      <div class="row section-heading">
        <h2 class="text-center"><b>Models</b></h2>
      </div>
      <div class="row models">
        <div class="col s12 m6">
          <div class="card">
            <div class="card-image waves-effect waves-block waves-light">
              <img class="activator" src="{{ asset('vendor/eclipse/img/database.jpeg') }}">
            </div>
            <div class="card-content">
              <span class="card-title activator grey-text text-darken-4 ">New Model</span>
              <br><br>
              <a href="/admin/models/new" class="btn-primary mb-10 z-depth-2">Create A New Model</a>
            </div>
          </div>
        </div>
        <div class="col s12 m6">
          <div class="card">
            <div class="card-image waves-effect waves-block waves-light">
              <img class="activator" src="{{ asset('vendor/eclipse/img/users.jpeg') }}">
            </div>
            <div class="card-content">
              <span class="card-title activator grey-text text-darken-4">Users</span>
              <br><br>
              <a href="/admin/users/admins" class="btn-primary darken-1 mb-10 z-depth-2">Browse Users Model</a>
            </div>
          </div>
        </div>
        @if(count($models) > 0)
          @foreach($models as $model)
            <div class="col s12 m6">
              <div class="card">
                <div class="card-image waves-effect waves-block waves-light">
                  <img class="activator" src="{{ asset('storage/model_images/'.$model->image) }}">
                </div>
                <div class="card-content" style="height:100px !important;">
                  <span class="card-title grey-text text-darken-4">{{ $model->name }}
                     <a><i class="activator fas fa-trash right"></i></a>
                   <a  href="/admin/models/edit/{{ $model->name }}/{{ $model->tableName }}"><i class="fa fa-edit right"></i></a>
                   <a href="/admin/models/browse/{{ $model->name }}/{{ $model->tableName }}"><i class="fas fa-eye right"></i></a>
                  </span>

                </div>
                <div class="card-reveal">
                  <span class="card-title grey-text text-darken-4">Are you sure  you want to delete the <i class="material-icons right">close</i></span><br>
                  <span class="card-title grey-text text-darken-4">{{ $model->name }} Model?</span>
                  <br>
                  <form action="/admin/models/delete" method="post">
                    @csrf
                    <input type="hidden" name="tableName" value="{{ $model->tableName }}">
                    <input type="hidden" name="modelName" value="{{ $model->name }}">
                    <button class="btn red z-depth-2" type="submit">Yes Delete</button>
                  </form>
                </div>
              </div>
            </div>
          @endforeach
        @endif
      </div>
    </div>
  </div>
  <!---/main content----->

@endsection
