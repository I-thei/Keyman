@extends('layouts.app')

@section('content')
	<h1>Add a New Provider</h1>

	<hr>

	@include('errors._list')

	{!! Form::model($provider = new \App\Provider, ['url' => 'providers']) !!}
		@include('providers._form', ['submitButtonText' => 'Add Provider'])
	{!! Form::close() !!}

@stop