@extends('layouts.app')

<link rel="stylesheet" href="/assets/css/add-edit.css">

@section('content')
<hr>

	@include('errors._list')

	<div class="col-md-3 col-md-offset-2">
		<div class="title-box">
			<center>Edit: {!! $insurance->name !!}</center>
		</div>
	</div>
	<div class="col-md-8 col-md-offset-2">
		<div class= "panel panel-default">
			{!! Form::model($insurance, ['method' => 'PATCH', 'action' => ['InsurancesController@update', $insurance->provider->id, $insurance->id]]) !!}
				@include('insurances._form', ['submitButtonText' => 'Update'])
			{!! Form::close() !!}

			@if (Auth::user()->isAdmin())
				{!! Form::open(['method' => 'DELETE', 'action' => ['InsurancesController@destroy', $insurance->provider->id, $insurance->id], 'class' => 'deleteForm']) !!}
					<fieldset class="form-group" style="padding-top: 0;"> 
						{!! Form::submit('Delete', ['class' => 'btn btn-danger col-xs-offset-4']) !!}
					</fieldset>
				{!! Form::close() !!}
			@endif
		</div>
	</div>

@stop