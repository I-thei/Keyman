@extends('layouts.app')

@section('content')
	<h1>Add a New Insurance to Customer</h1>

	<hr>

	@include('errors._list')

	{!! Form::open(['url' => 'customers/'. Request::segment(2) .'/insurances']) !!}
		@include('customers.insurances._form', ['submitButtonText' => 'Add Insurance'])
	{!! Form::close() !!}

@stop