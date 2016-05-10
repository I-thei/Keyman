@extends('layouts.app')

<link rel="stylesheet" href="/assets/css/add-edit.css">

@section('content')
	<hr>

	@include('errors._list')
	<div class="col-md-3 col-md-offset-2">
		<div class="title-box">
			<center>Edit: {!! $type->name !!}</center>
		</div>
	</div>
	<div class="col-md-8 col-md-offset-2">
		<div class= "panel panel-default">
			{!! Form::model($type, ['method' => 'PATCH', 'action' => ['TypesController@update', $type->id]]) !!}
				@include('types._form', ['submitButtonText' => 'Update'])
			{!! Form::close() !!}

			{!! Form::open(['method' => 'DELETE', 'action' => ['TypesController@destroy', $type->id], 'class' => 'deleteForm']) !!}
				<fieldset class="form-group" style="padding-top: 0;">
					{!! Form::submit('Delete', ['class' => 'btn btn-danger col-xs-offset-4']) !!}
				</fieldset>
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