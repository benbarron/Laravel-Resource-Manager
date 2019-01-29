@extends('admin.layouts.app')

@section('page-title', 'Edit Model')

@section('page-header', 'Edit Model')

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
    @if($model[0]->apiAccess == 0)
    <form action="/admin/models/enable/api-access/{{ $modelName }}/{{ $tableName }}" method="post">
      @csrf
      <button type="submit" class="btn btn-primary rounded-0 z-depth-2 mb-50">Enable Api Access</button>
    </form>
    @else
    <form action="/admin/models/disable/api-access/{{ $modelName }}/{{ $tableName }}" method="post">
      @csrf
      <button type="submit" class="btn btn-primary rounded-0 z-depth-2 mb-50">Disable Api Access</button>
    </form>
    @endif
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Type</th>
          <th scope="col">Name</th>
          <th scope="col">Default</th>
          <th>Extra</th>
          <th>Drop</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1; ?>
        @foreach($fields as $field)
        <tr>
          <td>{{ $i }}</td>
          <td>{{ $field->Type }}</td>
          <td>{{ $field->Field }}</td>
          <td>{{ $field->Default }}</td>
          <td>{{ $field->Extra }}</td>
          <td>
            @if($field->Field != "id" && $field->Field != "timeStamp")
            <form action="/admin/models/drop/column" method="post">
              @csrf
              <input type="hidden" name="modelName" value="{{ $modelName }}">
              <input type="hidden" name="tableName" value="{{ $tableName }}">
              <input type="hidden" name="columnName" value="{{ $field->Field }}">
              <button type="submit" class="btn btn-danger btn-sm red z-depth-2">Drop</button>
            </form>
            @endif
          </td>
        </tr>
        <?php $i++; ?>
        @endforeach
      </tbody>
      <form class="" action="/admin/models/update" method="post">
        @csrf
        <input type="hidden" name="modelName" value="{{ $modelName }}">
        <input type="hidden" name="tableName" value="{{ $tableName }}">
        <tbody id="edit-model-table">
          <tr>
            <td>{{ $i }} <input type="hidden" name="count-1" value="1"></td>
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
            <td>
              <input type="text" name="name-0" class="form-control rounded-0" value="">
            </td>
            <td>
              <input type="text" name="default-0" class="form-control rounded-0" value="">
            </td>
            <td>
              <input type="text" name="extra-0" class="form-control rounded-0" value="">
            </td>
            <td></td>
          </tr>
        </tbody>
        </tbody>
    </table>
    <button type="submit" class="btn btn-primary rounded-0 z-depth-1 ">Add Column</button>
    </form>
  </div>
</div>
@endsection
