@if(count($errors) > 0)
    <div class="w-100">
        <div class="alert alert-danger" style="background-color: #f66e84;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif


@if(Session::has('create'))
    <div class="alert alert-success w-100" style="height: 60px !important; padding: 0px 7px 0px !important; margin-bottom: 7px !important;  background-color: #3c763d">
        <h6 style="line-height: 0 !important; font-size: 12px !important; color: #d6e9c6 !important;">{!!  session('create') !!}}</h6>
    </div>
@endif

@if(Session::has('update'))
    <div class="alert alert-success w-100" style="height: 60px !important; padding: 0px 7px 0px !important; margin-bottom: 7px !important; font-size: 12px !important; background-color: #3c763d">
        <h6 style="line-height: 0 !important; font-size: 12px !important; color: #d6e9c6 !important;" >{!!  session('update') !!}}</h6>
    </div>
@endif


@if(Session::has('delete'))
    <div class="alert alert-success w-100" style="height: 60px !important; padding: 0px 7px 0px !important; margin-bottom: 7px !important; font-size: 12px !important; background-color: #3c763d">
        <h6 style="line-height: 0 !important; font-size: 12px !important; color: #d6e9c6 !important;">{!! session('delete') !!}}</h6>
    </div>
@endif


@if(Session::has('exception'))
    <div class="alert alert-danger w-100" style="background-color: #f66e84" >
        <h6 style="line-height: 0 !important; font-size: 12px !important;">{!! session('exception') !!}}</h6>
    </div>
@endif
