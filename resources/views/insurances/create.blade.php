@extends('layouts.app')

<link rel="stylesheet" href="/assets/css/add-edit.css">
<style>
	.select2-container{
		width: 75% !important;
	}
	.select2-selection{
		width:100% !important;
		border-radius: 0 !important;
		border-width: 2px !important;
		border-color: #888888 !important;
		height: 34px !important;
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
			<center>Add a New Insurance Plan to {{ $provider->name }}</center>
		</div>
	</div>
	<div class="col-md-8 col-md-offset-2">
		<div class= "panel panel-default">
			{!! Form::model($insurance = new \App\Insurance, ['url' => 'providers/'. Request::segment(2) .'/plans']) !!}
				@include('insurances._form', ['submitButtonText' => 'Add'])
			{!! Form::close() !!}
		</div>
	</div>
@stop