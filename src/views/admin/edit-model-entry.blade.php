@extends('admin.layouts.app')

@section('page-title', 'Edit Model Entry')

@section('page-header', 'Edit Model Entry')

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
        <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Gifts">
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
    <form action="/admin/models/update/entry/{{ $modelName }}/{{ $tableName }}/{{ $id }}" method="post">
      @csrf
      <input type="hidden" value="{{ $id }}" name="entry-id">
      <div class="">
        <?php $i = 0 ?>
        @foreach($fields as $field)
          @if($field->Type == "text")
          @elseif($field->Type == "tinyint(1)")
            @if($content->{$field->Field} == 1)
              <label for="">{{ $field->Field }}</label>
              <select name="{{ $field->Field }}" id="" class="form-control rounded-0 mb-50" value="{{ old($field->Field, $content->{$field->Field}) }}">
                <option value="1">True</option>
                <option value="0">False</option>
              </select>
            @else
            <label for="">{{ $field->Field }}</label>
            <select name="{{ $field->Field }}" id="" class="form-control rounded-0 mb-50" value="{{ old($field->Field, $content->{$field->Field}) }}">
              <option value="0">False</option>
              <option value="1">True</option>
            </select>
            @endif
          @else
            @if($field->Field != "id" && $field->Field != "timeStamp" && strtolower($field->Field) != "author")
            <div class="form-group">
              <label for="">{{ $field->Field }}</label>
              <input type="text" name="{{ $field->Field }}" class="form-control rounded-0" value="{{ old($field->Field, $content->{$field->Field}) }}">
            </div>
            @endif
          @endif
          <?php $i++ ?>
        @endforeach
        @foreach($fields as $field)
          @if($field->Type == "text")
          <div class="">
            <div class="input-field" >
              <textarea name="{{ $field->Field }}" id="" cols="30" rows="30" class="validate" placeholder="{{ $field->Field }}">
              {{ old($field->Field, $content->{$field->Field}) }}
              </textarea>
            </div>
          </div>
          @endif
        @endforeach
      </div>
      <div class="">
        <button type="submit" class="btn btn-primary rounded-0 z-depth-2 mt-50" style="width:200px;">Enter</button>
      </div>
    </form>
  </div>
</div>
@endsection

@section('js')
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>
  tinymce.init({
      selector:'textarea',
      branding: false,
      theme: 'modern',
      content_css: '{{asset('css/app.css')}}',
      height: 300,
      plugins: ["table lists pagebreak link autosave image imagetools code advlist textcolor colorpicker fullscreen"],
      advlist_bullet_styles: 'square circle',
      menubar: "file format edit table insert view",
      toolbar: " code | insertfile | table | numlist bullist | pagebreak | link | undo | bold | italic | image | forecolor | backcolor | fullscreen",
      image_advtab: true,
      images_upload_url: 'postAcceptor.php',
      images_upload_url: '/storage/app/public',
      //images_upload_base_path: '/storage/app/public/',
      images_upload_credentials: true,
      formats: {
        alignleft: {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'left'},
        aligncenter: {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'center'},
        alignright: {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'right'},
        alignjustify: {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'full'},
        bold: {inline : 'span', 'classes' : 'bold'},
        italic: {inline : 'span', 'classes' : 'italic'},
        underline: {inline : 'span', 'classes' : 'underline', exact : true},
        strikethrough: {inline : 'del'},
        forecolor: {inline : 'span', classes : 'forecolor', styles : {color : '%value'}},
        hilitecolor: {inline : 'span', classes : 'hilitecolor', styles : {backgroundColor : '%value'}},
        custom_format: {block : 'h1', attributes : {title : 'Header'}, styles : {color : 'red'}}
      },
      mobile: {
          theme: 'mobile',
          plugins: [ 'autosave', 'lists', 'autolink' ],
          toolbar: [ 'undo', 'bold', 'italic', 'styleselect' ]
      }
  });
</script>
@endsection
