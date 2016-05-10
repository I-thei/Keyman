@extends('layouts.app')

<link rel="stylesheet" href="/assets/css/add-edit.css">

@section('content')
	<hr>
	@include('errors._list')
	<div class="col-md-3 col-md-offset-2">
		<div class="title-box">
			<center>Add a New Request to {{ $customer->fullName }}</center>
		</div>
	</div>
	<div class="col-md-8 col-md-offset-2">
		<div class= "panel panel-default">
			{!! Form::model($krequest = new \App\KeymanRequest, ['action' => ['RequestsController@store', $customer->id]]) !!}
				@include('customers.requests._form', ['submitButtonText' => 'Add'])
			{!! Form::close() !!}
		</div>
	</div>

@stop

@section('footer')
	<script>
	    $(".deleteForm").on("submit", function(){
	        return confirm("Do you want to delete this item?");
	    });
	</script>
@stop