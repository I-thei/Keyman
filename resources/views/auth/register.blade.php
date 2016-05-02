@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">

                    {!! Form::open(['url' => '/register', 'class'=>'form-horizontal']) !!}
                        @include('auth._form', ['submitButtonText' => 'Register User'])
                        
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
