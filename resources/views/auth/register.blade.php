@extends('layouts.app')

<link rel="stylesheet" href="/assets/css/add-edit.css">

@section('content')
<hr>
    @include('errors._list')
    <div class="col-md-3 col-md-offset-2">
        <div class="title-box">
            <center>Register User</center>
        </div>
    </div>
    <div class="col-md-8 col-md-offset-2">
        <div class= "panel panel-default">
            {!! Form::open(['url' => '/register', 'class'=>'form-horizontal']) !!}
                @include('auth._form', ['submitButtonText' => 'Register'])
            {!! Form::close() !!}
        </div>
    </div>
@endsection
