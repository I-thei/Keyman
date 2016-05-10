
<link rel="stylesheet" href="/assets/css/login.css"> 

@extends('layouts.app')

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading"></div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                    {!! csrf_field() !!}
                    <br />
                    <div class="center">
                        <img src="/assets/images/KeymanLogo2.png" style="height:58px; width:60px">
                        <br />
                        <br />
                    </div>
                    <br />
                    <div class="blue form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="control-label narrow">EMAIL</label>
                        <div class="narrow">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                            @if ($errors->has('email')) 
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="blue no-margin form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label class="control-label narrow">PASSWORD</label>
                            <div class="narrow">
                                <input type="password" class="form-control" name="password">
                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                            </div>
                    </div>
                    <div class="form-group">                
                        <div class="checkbox">
                            <label>
                                 <input type="checkbox" name="remember"> Remember Me
                            </label>
                        </div>
                    </div>
                    <br />
                    <br />

                    <div class="form-group center">
                        <div class="col-md-8 col-md-offset-2">
                            <button type="submit" class="btn btn-primary center">
                                LOG IN
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
