@extends('admin.layouts.app')

@section('page-title', 'Media')

@section('page-header', 'Media Uploads')

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
        <li class="c-menu__item" data-toggle="tooltip" title="Gifts">
          <div class="c-menu__item__inner">
            <i class="fa fa-users"></i>
            <div class="c-menu-item__title"><span>Users</span></div>
          </div>
        </li>
      </a>
      <a href="/admin/models">
        <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Settings">
          <div class="c-menu__item__inner">
            <i class="fa fa-database"></i>
            <div class="c-menu-item__title"><span>Models</span></div>
          </div>
        </li>
      </a>
      <a href="/admin/media">
        <li class="c-menu__item is-active" data-toggle="tooltip" title="Settings">
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
<div class="row mb-100">
  <form action="/admin/images/store" method="post" enctype="multipart/form-data">
    @csrf
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <button type="submit" class="input-group-text" id="inputGroupFileAddon01">Upload</button>
      </div>
      <div class="custom-file">
        <input type="file" class="custom-file-input" name="image" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
      </div>
    </div>
  </form>
</div>
<div class="row">
  @if(count($images) > 0) 
    @foreach($images as $image)
      <div class="col-sm-12 col-md-2" style="padding:10px;">
        <i id="close-img-btn" class="far fa-times-circle"></i>
        <div id="overlay"></div>
        <img src="{{ asset('/storage/media_uploads/'.$image->fileName) }}" class="uploaded-image z-depth-2" style="width:100%;height:100%;" alt="">
        <form action="/admin/images/delete/{{ $image->fileName }}" method="post">
          @csrf
         <button type="submit" class="btn btn-danger rounded-0" style="postition:absolute;top:0;transform: translateY(-37px);">
            <i class="fas fa-minus-circle fa-2x" ></i>
         </button>
        </form>
      </div>  
    @endforeach
  @else 
  <alert class="alert alert-secondary">
    No Images Found
  </alert>
  @endif
</div>
@endsection

@section('css')
<style>
.uploaded-image:hover{
  cursor: pointer;
  opacity: 0.5;
  transition: 0.4s;
}
.uploaded-image.expand{
  position: fixed;
  left:50%;
  top:50%;
  width:80% !important;
  height:80% !important;
  transform: translate(-50%, -50%);
  z-index: 30;
  transition:0.2s;
}
.uploaded-image.expand:hover{
  opacity:1 !important;
}
#overlay{
  display: none;
}
#overlay.activate{
  display:block;
  position: fixed;
  left:0;
  top:0;
  width:100% !important;
  height:100% !important;
  z-index: 15;
  background: rgba(0,0,0,0.5);
  transition: 0.3s ease-in;
}
#close-img-btn{
  display:none;
}
#close-img-btn.show{
  display:block;
  z-index: 20;
  position: fixed;
  top:50px;
  right:50px;
  font-size:30px;
  color:#fff;  
  transition: 0.3s;
}
#close-img-btn.show:hover{
  color:#555;
  transition: 0.3s;
  cursor:pointer;
}
</style>
@endsection

@section('js')
<script>
$('.uploaded-image').on('click', function(e) {
  $('.uploaded-image').removeClass('expand');
  $('#overlay').addClass('activate');
  $('#close-img-btn').addClass('show');
  $(this).addClass('expand');
  $(this).removeClass('z-depth-2');
  $(this).addClass('z-depth-4');
});
$('#close-img-btn').on('click', function() {
  $('.uploaded-image').removeClass('expand');
  $('#overlay').removeClass('activate');
  $('.uploaded-image').removeClass('z-depth-4');
  $('.uploaded-image').addClass('z-depth-2');
  $(this).removeClass('show');
});
</script>
@endsection

