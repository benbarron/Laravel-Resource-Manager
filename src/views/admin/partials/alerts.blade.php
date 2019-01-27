<style>
.alert{
    width:100%;
}
</style>
@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="center alert alert-danger">
            {{$error}}
        </div>
    @endforeach
@endif


@if(session('green'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success! </strong> {{ session('green') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session('info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong>Success! </strong> {{ session('info') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session('blue'))
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <strong>Just So You Know! </strong> {{ session('blue') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session('yellow'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Hold Up! </strong> {{ session('yellow') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session('red'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error! </strong> {{ session('red') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif