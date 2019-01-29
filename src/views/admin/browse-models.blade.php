@extends('admin.layouts.app')

@section('page-title', 'Browse Model')

@section('page-header', 'Browse Model')

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
    <a href="/admin/models/new-entry/{{ $modelName }}/{{ $tableName }}" class="btn btn-primary rounded-0 z-depth-1 mb-20">New Entry</a>
  </div>
  <div class="col-sm-12 col-md-9 justify-content-end">
    <ul class="nav justify-content-end">
      <li class="nav-item">
        <a href="/admin/models/edit/{{ $modelName }}/{{ $tableName }}" class="btn btn-secondary rounded-0 z-depth-1 mb-20 ml-20" >Edit Structure</a>
      </li>
    </ul>
  </div>
</div>
<div class="">
  <table class="table">
    <thead class="thead-dark">
      @foreach($fields as $field)
      @if($field->Type == "text")
      @else
      <th>{{ $field->Field }}</th>
      @endif
      @endforeach
      <th>Edit</th>
      <th>Delete</th>
    </thead>
    @if(count($items) > 0)
    <tbody>
      @php
        $i = 0;
      @endphp
      @foreach($items as $item)
        <tr id="entry-{{ $i }}">
          @php
            $i = 0;
          @endphp
          @foreach($fields as $field)
            @if($field->Field == "timeStamp")
              <td>{{ date("m/d/Y", $item->{$field->Field}) }}</td>
            @elseif($field->Type == "text")
            @elseif($field->Default == "image")
              <td><img src="{{ asset('storage/uploads/'.$item->{$field->Field}) }}" style="width:50px;width:50px;"></td>
            @else
              @if($i == 2)
                <td class="entry">{!! $item->{$field->Field} !!}</td>
              @else
                <td >{!! $item->{$field->Field} !!}</td>
              @endif
            @endif
            @php
              $i++;
            @endphp
          @endforeach
          <td>
            <a href="/admin/models/edit/entry/{{ $modelName }}/{{ $tableName }}/{{ $item->id }}" class="btn btn-primary btn-sm z-depth-1 rounded-0">Edit Entry</a>
          </td>
          <td>
            <form action="/admin/models/delete/entry/{{ $modelName }}/{{ $tableName }}" method="post">
              @csrf
              <input type="hidden" name="id" value="{{ $item->id }}">
              <button class="btn btn-danger btn-sm z-depth-1 rounded-0">Delete Entry</button>
            </form>
          </td>
        </tr>
        @php
          $i++;
        @endphp
      @endforeach
    </tbody>
    @else
    <tbody>
      <tr>
        <td>There Are No Entries In The {{ $modelName }} model. Click Below To Create One.</td>
        @for($i = 1; $i < count($fields) + 2; $i++)
        <td></td>
        @endfor
      </tr>
    </tbody>
    @endif
  </table>
</div>
<br>
</div>
@endsection
