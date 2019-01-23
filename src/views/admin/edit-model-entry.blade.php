@extends('admin.layouts.app')
@section('title', 'Laravel Eclipse')
@section('content')
  <!---main content----->
  <div class="main">
    <div class="container">
      <div class="row section-heading">
        <h2 class="text-center"><b>Edit Entry In The {{ $modelName }} Model</b></h2>
      </div>
      <div class="row">
      	<form action="/admin/models/update/entry/{{ $modelName }}/{{ $tableName }}/{{ $id }}" method="post">
	      	@csrf
	      	<input type="hidden" value="{{ $id }}" name="entry-id">
		      <div class="row">
		      	<?php $i = 0 ?>
		      	@foreach($fields as $field)
							@if($field->Type == "text")
							@elseif($field->Type == "boolean")
								<select name="{{ $field->Field }}" value="{{ $content->{$field->Field} }}" id="" required="">
									<option value="1">True</option>
									<option value="0">False</option>
								</select>
							@else
								@if($field->Field != "timeStamp" && strtolower($field->Field) != "author")
                  @if($field->Field == "id")
                  <input type="hidden" name="{{$field->Field }}" value="{{ $content->{$field->Field} }}" required="">
                  @else 
  									<div class="">
  			              <div class="input-field">
  			                <i class="material-icons prefix">fiber_manual_record</i>
  			                <input id="icon_prefix{{ $i }}" type="text" name="{{ $field->Field }}" class="validate" value="{{ $content->{$field->Field} }}" required="">
  			                <label for="icon_prefix{{ $i }}">{{ $field->Field }}</label>
  			              </div>
  			            </div>
                  @endif
		            @endif
							@endif
							<?php $i++ ?>
		      	@endforeach
            @foreach($fields as $field)
              @if($field->Type == "text")
                <div class="">
                  <div class="input-field" >
                    <textarea name="{{ $field->Field }}"  class="validate" required="">{{ $content->{$field->Field} }}</textarea>
                  </div>
                </div>
              @endif
            @endforeach
		      </div>
		      <div class="row">
		      	<button type="submit" class="btn-primary z-depth-2">Enter</button>
		      </div>
	      </form>
      </div>
    </div>
  </div>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>
          tinymce.init({
              selector:'textarea',
              branding: false,
              theme: 'modern',
              content_css: '{{asset('css/app.css')}}',
              height: 500,
              plugins: ["table lists pagebreak link autosave image imagetools code advlist textcolor colorpicker fullscreen"],
              advlist_bullet_styles: 'square circle',
              menubar: "file format edit table insert view",
              toolbar: " code | insertfile | table | numlist bullist | pagebreak | link | undo | bold | italic | image | forecolor | backcolor | fullscreen",
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