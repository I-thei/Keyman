@extends('layouts.app')

@section('content')
	<h1>Edit: {!! $customer->first_name . ' ' . $customer->last_name . ', ' . $customer->middle_name  !!}</h1>
	
	<hr>

	@include('errors._list')

	{!! Form::model($customer, ['method' => 'PATCH', 'action' => ['CustomersController@update', $customer->id]]) !!}
		@include('customers._form', ['submitButtonText' => 'Update Customer'])
	{!! Form::close() !!}

	@if (Auth::user()->isAdmin())
		{!! Form::open(['method' => 'DELETE', 'action' => ['CustomersController@destroy', $customer->id], 'id' => 'deleteForm']) !!}
			<fieldset class="form-group"> 
				{!! Form::submit('Delete Customer', ['class' => 'btn btn-danger']) !!}
			</fieldset>
		{!! Form::close() !!}
	@endif

@stop

@section('footer')
	<script>
	    $("#deleteForm").on("submit", function(){
	        return confirm("Do you want to delete this item?");
	    });
	</script>
@stop