
<style>
    .alert-1{
        padding:15px;
        margin-bottom:20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .alert-green{
        color:#3c763d;
        background-color:#dff0d8;
        border-color:#d6e9c6;
    }

    .alert-red{
        color:#a94442;
        background-color:#f2dede;
        border-color:#ebccd1;
    }

    .alert-yellow{
        color: #f39c12;
        background: #f1c40f;
        border: #f39c12;
    }
    .alert-blue{
        background: : #3498db;
        color: #0652DD;
        border: #0652DD;
    }
</style>
@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="center alert-1 alert-red">
            {{$error}}
        </div>
    @endforeach
@endif


@if(isset($green))
    <div class="center alert-1 alert-green">
        {{ $green }}
    </div>
@endif

@if(session('yellow'))
    <div class="center alert-1 alert-yellow">
        {{session('yellow')}}
    </div>
@endif

@if(session('blue'))
    <div class="center alert-1 alert-blue">
        {{session('blue')}}
    </div>
@endif

@if(session('red'))
    <div class="center alert-1 alert-red">
        {{session('red')}}
    </div>
@endif
