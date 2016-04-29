@extends('layouts.app')

<style>

body {
    padding-top: 5%;
}

.form-horizontal .control-label {
    padding-top: 20px;
    text-align: left;
    font-family: 'Nav';
}

.navbar-default {
    display: none;
}

a.btn.btn-link {
    font-size: 12px;
    color: rgb(38,38,38);
    padding-left: 0;
    padding-top: 20px;
}

.form-group {
    padding: 2% 5% 2% 5%;
}

.btn.btn-primary {
    width: 50%;
    margin-left: 25%;
    min-width: 96px;
    text-align: center;
}

.checkbox {
    margin-left: 38.5%;
}

@media (min-width: 992px) {
    .form-group {
        padding-top: 2%;
        margin-bottom: 0;
    }
    .btn.btn-primary {
        width: 100%;
        margin: 0;
    }
    .checkbox {
        margin-left: 20%;
    }

}

@media (min-width: 764px) {

    a.btn.btn-link {
        text-align: center;
        margin-bottom: 0;
        padding: 0;
        width: 100%;
    }

}
@media (max-width: 480px) {
    .checkbox {
        margin-left: 0;
    }   
}

    
</style>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {!! csrf_field() !!}
                        <div class="center">
                            <img src="/assets/images/KeymanLogo2.png" style="height:100px; width: 110px">
                        </div>
                        <br />
                        <div class="blue form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label narrow">E-MAIL:</label>

                            <div class="col-md-6 narrow">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="blue form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label narrow">PASSWORD:</label>
                            <div class="col-md-6 narrow">
                                <input type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <a class="btn btn-link center" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="btn btn-primary center">
                                    <i class="fa fa-btn fa-sign-in"></i>LOG IN
                                </button>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
