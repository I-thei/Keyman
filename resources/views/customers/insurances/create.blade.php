@extends('layouts.app')

@section('content')
	<h1>Add a New Insurance to Customer</h1>

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

	{!! Form::open(['url' => 'customers/'. Request::segment(2) .'/insurances']) !!}
		@include('customers.insurances._form', ['submitButtonText' => 'Add Insurance'])
	{!! Form::close() !!}

@stop