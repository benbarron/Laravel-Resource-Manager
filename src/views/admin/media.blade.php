@extends('admin.layouts.app')
@section('title', 'Laravel Eclipse')
@section('content')
  <!---main content----->
  <div class="main">
    <div class="container">
      <div class="row section-heading">
        <h2><b>Image Upload</b></h2>
      </div>
      <div class="row">
      	<form action="/admin/images/store" method="post" enctype="multipart/form-data">
      		@csrf 
			    <div class="file-field input-field">
			      <div class="btn grey z-depth-2">
			        <span>File</span>
			        <input type="file" name="image">
			      </div>
			      <div class="file-path-wrapper">
			        <input class="file-path validate" type="text">
			      </div>
			      <div>
			      	<br>
			      	<button type="submit" class="btn blue btn-small">Upload<i class="material-icons left">cloud</i></button>
			      	<span class="right" style="transform: translateY(-35px);">
 								{{ $images->links() }}
			      	</span>
			
			      </div>
			    </div>
			  </form>
      </div>
		  <div class="row">
		  	@if(count($images) > 0)
			  	@foreach($images as $image)
			    <div class="col s12 m3">
			      <div class="card" style="height: 300px;overflow: hidden;">
			        <div class="card-image">
			          <img src="{{ asset('/storage/media_uploads/'.$image->fileName) }}">
								<form action="/admin/images/delete/{{ $image->fileName }}" method="post">
									@csrf 
			         		<button class="btn-floating halfway-fab waves-effect waves-light red" type="submit"><i class="fas fa-trash"></i></button>
			          </form>
			        </div>
			        <div class="card-content">
			          <p> {{ $image->url }}</p>
			        </div>
			      </div>
			    </div>
			    @endforeach
		    @else
		    @endif
		  </div>
    </div>
  </div>
@endsection