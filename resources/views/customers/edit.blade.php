@extends('layouts.app')

<link rel="stylesheet" href="/assets/css/add-edit.css">

@section('content')
	<hr>

	@include('errors._list')

	<div class="col-md-3 col-md-offset-2">
		<div class="title-box">
			<center>Edit: {!! $customer->fullName  !!}</center>
		</div>
	</div>
	<div class="col-md-8 col-md-offset-2">
		<div class= "panel panel-default">

	{!! Form::model($customer, ['method' => 'PATCH', 'action' => ['CustomersController@update', $customer->id]]) !!}
		@include('customers._form', ['submitButtonText' => 'Update'])
	{!! Form::close() !!}

	@if (Auth::user()->isAdmin())
		{!! Form::open(['method' => 'DELETE', 'action' => ['CustomersController@destroy', $customer->id], 'class' => 'deleteForm']) !!}
			<fieldset class="form-group" style="padding-top: 0;">
				{!! Form::submit('Delete', ['class' => 'btn btn-danger col-xs-offset-4']) !!}
			</fieldset>
		{!! Form::close() !!}
	@endif

@stop

@section('footer')
	<script>
	    $(".deleteForm").on("submit", function(){
	        if (confirm("Do you want to delete this Customer?")) {
	        	if(confirm("Are you sure? This will delete all Requests and records of Insurances of the Customer.")) {
	        		return(confirm("For the last time, are you sure you want to delete this?"));
	        	};
	        };
	        return false;
	    });
	</script>
@stop