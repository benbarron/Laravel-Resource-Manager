@extends('admin.layouts.app')

@section('page-title', 'Models')

@section('page-header', 'Models')

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
        <li class="c-menu__item " data-toggle="tooltip" title="Gifts">
          <div class="c-menu__item__inner">
            <i class="fa fa-users"></i>
            <div class="c-menu-item__title"><span>Users</span></div>
          </div>
        </li>
      </a>
      <a href="/admin/models">
        <li class="c-menu__item is-active" data-toggle="tooltip" title="Settings">
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
      <li class="c-menu__item" data-toggle="tooltip" title="Settings">
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
  <div class="col-sm-12 col-md-3">
    <a href="/admin/models/new" class="btn btn-primary rounded-0 z-depth-1 mb-20">Create Model</a>
  </div>
  <div class="col-sm-12 col-md-9 justify-content-end">
    <ul class="nav justify-content-end">
      <li class="nav-item">
        <form class="form-inline">
          <div class="form-group mx-sm-3 mb-2">
            <input type="text" class="form-control rounded-0" id="search-input" placeholder="Filter Models...">
          </div>
        </form>
      </li>
    </ul>
  </div>
</div>
<div class="">
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th>Model Name</th>
        <th>Tabel Name</th>
        <th>Created On</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>User</td>
        <td>users</td>
        <td>-------</td>
        <td>-------</td>
        <td>-------</td>
        <td><a href="/admin/users/all?view=all" class="btn btn-primary btn-sm rounded-0 z-depth-1">View Users</a></td>
        <td>--------</td>
      </tr>
      @if(count($models) > 0)
        @php
          $i = 0;
        @endphp
        @foreach($models as $model)
        <tr id="model-{{ $i }}">
          <td class="model-name">{{ $model->name }} </td>
          <td>{{ $model->tableName }}</td>
          <td>{{ $model->created_at }}</td>
          <td><a href="/admin/models/edit/{{ $model->name }}/{{ $model->tableName }}" class="btn btn-secondary btn-sm rounded-0 z-depth-1">Edit</a></td>
          <td><a href="/admin/models/new-entry/{{ $model->name }}/{{ $model->tableName }}" class="btn btn-success btn-sm rounded-0 z-depth-1">New Entry</a></td>
          <td><a href="/admin/models/browse/{{ $model->name }}/{{ $model->tableName }}" class="btn btn-primary btn-sm rounded-0 z-depth-1">View Entries</a></td>
          <td>
            <form action="/admin/models/delete" method="post">
              @csrf
              <input type="hidden" name="tableName" value="{{ $model->tableName }}">
              <input type="hidden" name="modelName" value="{{ $model->name }}">
              <button type="submit" class="btn btn-danger btn-sm rounded-0 z-depth-1">Delete Model</button>
            </form>
          </td>
        </tr>
        @php
          $i++;
        @endphp
        @endforeach
      @endif
    </tbody>
  </table>
</div>
<br>
<div class="">
  {{ $models->links() }}
</div>
</div>
@endsection

@section('js')
<script>
  let filterInput = document.getElementById('search-input');
  filterInput.addEventListener('keyup', filterUsers);
  function filterUsers() {
    let filterValue = document.getElementById('search-input').value.toUpperCase();
    let models = $('.model-name');
    for(let i = 0; i < models.length; i++) {
      if(models[i].innerHTML.toUpperCase().indexOf(filterValue) > -1) {
          document.getElementById('model-'+i).style.display = '';
      } else {
        document.getElementById('model-'+i).style.display = 'none';
      }
    }
    console.log(filterValue);
  }
</script>
@endsection
