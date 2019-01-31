@extends('admin.layouts.app')

@section('page-title', 'New Model')

@section('page-header', 'New Model')

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
        <li class="c-menu__item" data-toggle="tooltip" title="Gifts">
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
    <form action="/admin/create/model" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="">Model name</label>
      <input type="text" name="name" id="" placeholder="Model Name" class="form-control rounded-0" value="{{ old('name') }}">
    </div>
    <br>
    @php
    if(isset($_GET['error']) && $_GET['error'] == "taken"){
    echo "<span style='color:#aa0000;'>There is already a model with that name</span><br>";
    }
    @endphp
    <div class="custom-control custom-switch">
      <input type="checkbox" class="custom-control-input" name="api_access" id="customSwitch1" >
      <label class="custom-control-label" for="customSwitch1">Api Access</label>
    </div>
    <br><br>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Type</th>
          <th scope="col">Name</th>
          <th scope="col">Default</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">!</th>
          <td>Integer</td>
          <td>Id</td>
          <td>autoincrements</td>
        </tr>
      </tbody>
      <tbody>
        <tr>
          <th scope="row">!</th>
          <td>Integer</td>
          <td>TimeStamp</td>
          <td>Current TimeStamp</td>
        </tr>
      </tbody>
      <tbody>
        <tr>
          <th>1 <input type="hidden" name="count-1" value="1"></th>
          <td>
            <select name="data-type-0" class="form-control rounded-0" id="">
              <option value="string">String</option>
              <option value="integer">Integer</option>
              <option value="text">Text</option>
              <option value="float">Float</option>
              <option value="boolean">Boolean</option>
              <option value="image">Image</option>
            </select>
          </td>
          <td><input type="text" name="name-0" class="form-control rounded-0"></td>
          <td><input type="text" name="default-0" class="form-control rounded-0"></td>
        </tr>
      </tbody>
      <tbody id="insert1"></tbody>
      <tbody id="insert2"></tbody>
      <tbody id="insert3"></tbody>
      <tbody id="insert4"></tbody>
      <tbody id="insert5"></tbody>
      <tbody id="insert6"></tbody>
      <tbody id="insert7"></tbody>
      <tbody id="insert8"></tbody>
      <tbody id="insert9"></tbody>
      <tbody id="insert10"></tbody>
      <tbody id="insert11"></tbody>
      <tbody id="insert12"></tbody>
      <tbody id="insert13"></tbody>
      <tbody id="insert14"></tbody>
    </table>
    <button type="submit" class="btn btn-primary rounded-0 z-depth-1 ">Create Model</button>
    <a class="btn btn-secondary rounded-0 z-depth-1 ml-20" id="add-column-to-table" style="color:white;">Add Column</a>
    <a class="btn btn-danger rounded-0 z-depth-1 ml-20" id="remove-column-to-table" style="color:white;">Remove Column</a>
  </div>
</div>
@endsection
