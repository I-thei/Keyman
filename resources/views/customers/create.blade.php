@extends('layouts.app')

<link rel="stylesheet" href="/assets/css/add-edit.css">

@section('content')
	<hr>

	@include('errors._list')
	<div class="col-md-3 col-md-offset-2">
		<div class="title-box">
			<center>Add New Customer</center>
		</div>
	</div>
	<div class="col-md-8 col-md-offset-2">
		<div class= "panel panel-default">
			{!! Form::model($customer = new \App\Customer, ['url' => 'customers']) !!}
				@include('customers._form', ['submitButtonText' => 'Add'])
			{!! Form::close() !!}
		</div>
	</div>
@stop