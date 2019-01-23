@extends('admin.layouts.app')

@section('title', 'Laravel Eclipse')


@section('content')
  <!---main content----->
  <div class="main">
    <div class="container">
      <div class="row section-heading">

        <nav>
          <div class="nav-wrapper">
            <a href="#" class="brand-logo">Entries In The {{ $modelName }} model</a>
            <ul class="right">
              <a href="/admin/models/new-entry/{{ $modelName }}/{{ $tableName }}" class="btn grey z-depth-2">New Entry</a>
            </ul>
          </div>
        </nav>
        <br>
      </div>
      <div class="row">
        <table class="z-depth-2">
          <thead>
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
              @foreach($items as $item)
                <tr>
                  @foreach($fields as $field)
                    @if($field->Field == "timeStamp")
                      <td>{{ date("m/d/Y", $item->{$field->Field}) }}</td>
                    @elseif($field->Type == "text")
                    @else 
                      <td>{!! $item->{$field->Field} !!}</td>
                    @endif
                  @endforeach
                  <td>
                    <a href="/admin/models/edit/entry/{{ $modelName }}/{{ $tableName }}/{{ $item->id }}" class="btn btn-small blue z-depth-2"><i class="fa fa-edit"></i></a>
                  </td>
                  <td>
                    <form action="/admin/models/delete/entry/{{ $modelName }}/{{ $tableName }}" method="post">
                      @csrf
                      <input type="hidden" name="id" value="{{ $item->id }}">
                      <button class="btn btn-small red z-depth-2"><i class="fas fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
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
        @if(count($items) > 0)
          {{ $items->links() }}            
        @endif
      </div>
      <div class="row mt-60">

      </div>
    </div>
  </div>
@endsection
