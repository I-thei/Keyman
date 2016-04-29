@extends('layouts.app')

@section('content')
	<h1>Edit: {!! $provider->name !!}</h1>
	
	<hr>

	@include('errors._list')

	{!! Form::model($provider, ['method' => 'PATCH', 'action' => ['ProvidersController@update', $provider->id]]) !!}
		@include('providers._form', ['submitButtonText' => 'Update Provider'])
	{!! Form::close() !!}

	@if (Auth::user()->isAdmin())
		{!! Form::open(['method' => 'DELETE', 'action' => ['ProvidersController@destroy', $provider->id], 'id' => 'deleteForm']) !!}
			<fieldset class="form-group"> 
				{!! Form::submit('Delete Provider', ['class' => 'btn btn-danger']) !!}
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