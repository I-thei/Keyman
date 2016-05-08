@extends('layouts.app')

@section('content')
	<h1>Edit: {!! $customer->fullName  !!}</h1>
	
	<hr>

	@include('errors._list')

	{!! Form::model($customer, ['method' => 'PATCH', 'action' => ['CustomersController@update', $customer->id]]) !!}
		@include('customers._form', ['submitButtonText' => 'Update Customer'])
	{!! Form::close() !!}

	@if (Auth::user()->isAdmin())
		{!! Form::open(['method' => 'DELETE', 'action' => ['CustomersController@destroy', $customer->id], 'class' => 'deleteForm']) !!}
			<fieldset class="form-group"> 
				{!! Form::submit('Delete Customer', ['class' => 'btn btn-danger']) !!}
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