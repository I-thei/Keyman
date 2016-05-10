@extends('layouts.app')

<link rel="stylesheet" href="/assets/css/add-edit.css">

@section('content')
<hr>
<div class="col-md-3 col-md-offset-2">
        <div class="title-box">
            <center>Update Account Information</center>
        </div>
    </div>
    <div class="col-md-8 col-md-offset-2">
        <div class= "panel panel-default">
            {!! Form::model(Auth::user(), ['method' => 'PATCH', 'action' => ['Auth\AuthController@update', Auth::id()], 'class'=>'form-horizontal']) !!}
                @include('auth._form', ['submitButtonText' => 'Update', 'passwordText' => 'New Password:'])
            {!! Form::close() !!}
    </div>
</div>
@endsection
