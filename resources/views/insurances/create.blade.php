@extends('layouts.app')

@section('content')
	<h1>Add a New Insurance Plan</h1>

	<hr>

	@if (count($errors) > 0)
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif

	{!! Form::model($insurance = new \App\Insurance, ['url' => 'providers/'. Request::segment(2) .'/plans']) !!}
		@include('insurances._form', ['submitButtonText' => 'Add Insurance'])
	{!! Form::close() !!}

@stop