@extends('layouts.app')

@section('content')
	<h1>Edit: {!! $insurance->name !!}</h1>
	
	<hr>

	@include('errors._list')

	{!! Form::model($insurance, ['method' => 'PATCH', 'action' => ['InsurancesController@update', $insurance->provider->id, $insurance->id]]) !!}
		@include('insurances._form', ['submitButtonText' => 'Update Insurance'])
	{!! Form::close() !!}

	@if (Auth::user()->isAdmin())
		{!! Form::open(['method' => 'DELETE', 'action' => ['InsurancesController@destroy', $insurance->provider->id, $insurance->id], 'id' => 'deleteForm']) !!}
			<fieldset class="form-group"> 
				{!! Form::submit('Delete Insurance', ['class' => 'btn btn-danger']) !!}
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