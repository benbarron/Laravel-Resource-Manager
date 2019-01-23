@extends('admin.layouts.app')

@section('title', 'Laravel Eclipse')


@section('content')
  <!---main content----->
  <div class="main">
    <div class="container">
      <div class="row">
        @include('admin.alerts.messages')
      </div>
      <div class="row">
        <nav>
          <div class="nav-wrapper">
            <a href="#" class="brand-logo">Edit {{ $modelName }} Model</a>
            <ul id="nav-mobile" class="right ">
              @if($model[0]->apiAccess == 0)
              <form action="/admin/models/enable/api-access/{{ $modelName }}/{{ $tableName }}" method="post">
                @csrf
                <button type="submit" class="btn grey  z-depth-2">Enable Api Access</button>
              </form>
              @else
                <form action="/admin/models/disable/api-access/{{ $modelName }}/{{ $tableName }}" method="post">
                  @csrf
                  <button type="submit" class="btn grey z-depth-2">Disable Api Access</button>
                </form>
              @endif
            </ul>
          </div>
        </nav>
      </div>
      <div class="row">
        <table class="z-depth-2">
          <thead>
            <tr>
              <th>#</th>
              <th>Type</th>
              <th>Name</th>
              <th>Default</th>
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
                  @if($field->Field != "id" && $field->Field != "timeStamp" && $field->Field != "name")
                    <form action="/admin/models/drop/column" method="post">
                      @csrf 
                      <input type="hidden" name="modelName" value="{{ $modelName }}">
                      <input type="hidden" name="tableName" value="{{ $tableName }}">
                      <input type="hidden" name="columnName" value="{{ $field->Field }}">
                      <button type="submit" class="btn btn-small red z-depth-2">Drop</button>
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
                  <select name="data-type-0" id="">
                    <option value="string">String</option>
                    <option value="integer">Integer</option>
                    <option value="text">Text</option>
                    <option value="float">Float</option>
                    <option value="boolean">Boolean</option>
                  </select>
                </td>
                <td>
                  <input type="text" name="name-0" value="">
                </td>
                <td>
                  <input type="text" name="default-0" value="">
                </td>
                <td>
                  <input type="text" name="extra-0" value="">
                </td>
              </tr>
            </tbody>
          </table>
          <div class="row mt-50">
          <br>
          <button type="submit" class="btn green z-depth-2 mr-20 mb-20">Add Column</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!---/main content----->

@endsection
