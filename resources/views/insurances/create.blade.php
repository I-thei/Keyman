@extends('layouts.app')

@section('content')
	<h1>Add a New Insurance Plan</h1>

	<hr>

	@include('errors._list')

	{!! Form::model($insurance = new \App\Insurance, ['url' => 'providers/'. Request::segment(2) .'/plans']) !!}
		@include('insurances._form', ['submitButtonText' => 'Add Insurance'])
	{!! Form::close() !!}

@stop