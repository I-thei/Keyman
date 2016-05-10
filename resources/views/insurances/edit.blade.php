@extends('layouts.app')

<link rel="stylesheet" href="/assets/css/add-edit.css">
<style>
	.select2-container{
		width: 70% !important;
	}

	@media (max-width: 767px) {
		.select2-container{
			width: 100% !important;
		}
	}
	.select2-selection{
		width:100% !important;
		border-radius: 0 !important;
		border-width: 2px !important;
		border-color: #888888 !important;
		height: 34px !important;
		padding: 2px 4px 0 !important;
	}
	.select2-selection__arrow{
		height: 34px !important;
	}
	.select2-container--default .select2-selection--single .select2-selection__arrow b{
		display: initial !important;
	}
</style>

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