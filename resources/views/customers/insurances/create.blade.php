@extends('layouts.app')

<link rel="stylesheet" href="/assets/css/add-edit.css">
<style>

	.select2-container{
		width: 60% !important;
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
			<center>Add a New Insurance to {{ $customer->fullName }}</center>
		</div>
	</div>
	<div class="col-md-8 col-md-offset-2">
		<div class= "panel panel-default">
			{!! Form::open(['action' => ['CustomerInsurancesController@store', $customer->id]]) !!}
				@include('customers.insurances._form', ['submitButtonText' => 'Add'])
			{!! Form::close() !!}
		</div>
	</div>

@stop