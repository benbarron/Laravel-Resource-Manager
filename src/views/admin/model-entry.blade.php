@extends('admin.layouts.app')

@section('title', 'Laravel Eclipse')

@section('content')
  <!---main content----->
  <div class="main">
    <div class="container">
      <div class="row section-heading">
        <h2 class="text-center"><b>New Entry For {{ $modelName }} Model</b></h2>
      </div>
      <form action="/admin/models/store/entry/{{ $modelName }}/{{ $tableName }}" method="post">
      	@csrf
	      <div class="row">
	      	<?php $i = 0 ?>
	      	@foreach($fields as $field)
						@if($field->Type == "text")
						@elseif($field->Type == "boolean")
							<select name="{{ $field->Field }}" id="" value={{ old($field->Field) }}>
								<option value="1">True</option>
								<option value="0">False</option>
							</select>
						@else
							@if($field->Field != "id" && $field->Field != "timeStamp" && strtolower($field->Field) != "author")
								<div class="">
		              <div class="input-field">
		                <i class="material-icons prefix">fiber_manual_record</i>
		                <input id="icon_prefix{{ $i }}" type="text" name="{{ $field->Field }}" class="validate" value={{ old($field->Field) }}>
		                <label for="icon_prefix{{ $i }}">{{ $field->Field }}</label>
		              </div>
		            </div>
	            @endif
						@endif
						<?php $i++ ?>
	      	@endforeach
          @foreach($fields as $field)
            @if($field->Type == "text")
            <div class="">
              <div class="input-field" >
                <textarea name="{{ $field->Field }}" id="" cols="30" rows="30" class="validate" placeholder="{{ $field->Field }}">{{ old($field->Field) }}</textarea>
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

              images_upload_handler: function (blobInfo, success, failure) {
                  var xhr, formData;
                  xhr = new XMLHttpRequest();
                  xhr.withCredentials = false;
                  xhr.open('POST', 'postAcceptor.php');
                  xhr.onload = function() {
                    var json;

                    if (xhr.status != 200) {
                      failure('HTTP Error: ' + xhr.status);
                      return;
                    }
                    json = JSON.parse(xhr.responseText);

                    if (!json || typeof json.location != 'string') {
                      failure('Invalid JSON: ' + xhr.responseText);
                      return;
                    }
                    success(json.location);
                  };
                  formData = new FormData();
                  formData.append('file', blobInfo.blob(), fileName(blobInfo));
                  xhr.send(formData);
              },



              mobile: {
                  theme: 'mobile',
                  plugins: [ 'autosave', 'lists', 'autolink' ],
                  toolbar: [ 'undo', 'bold', 'italic', 'styleselect' ]
              }
          });

      </script>
@endsection