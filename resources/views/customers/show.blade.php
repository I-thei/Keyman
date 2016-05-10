@extends('layouts.app')
<link rel="stylesheet" href="/assets/css/requests.css">
<link rel="stylesheet" href="/assets/css/tablecard.css">
<link rel="stylesheet" href="/assets/css/account.css">
  
@section('content')
	<hr>
	<br />

	<div class="bgblue" style="display: inline-block; margin: 0">
		<div style="margin: 8px; width: 50%; display: inline-flex;">
			<div>
				<div style="background-color: white; border-radius: 50%; width:76px;
				height: 76px; font-size: 50px; color: rgb(233,130,51); text-align: center; font-family: 'Nav'; line-height: 76px; margin: 10px;">
					{{ $customer->fullName[0] }}
				</div>
			</div> 

			<div id ="add" style="display: inline-table; float: left; margin: 10px;">
				<div class="upper" style="font-size: 18px">
					{{ $customer->fullName }}
				</div>
				{{ $customer->email }}<br />
				{{ $customer->phone_num }}<br />
				<a id="editButton" href ="{{ action('CustomersController@edit', [$customer->id])}}" class="btn addButton" style="padding:0;font-size:12px;color:rgb(233,130,51);height: 20px;">
					EDIT PROFILE
				</a>
			</div>
		</div>
		<div style="margin-top: 5px; display: inline-block; float: right; width: 30px; z-index: 5;"></div>
	</div>

	<hr style="margin-top: 0; padding-top: 10px; border-top: 0; border-bottom: 1px; background-color: rgb(233,130,51)";>

	<br />

	<div class= "form-group" style="display: inline-flex; margin-bottom: 0;">
		<h3 style="width: initial; font-size: 36px; margin: 0;margin-bottom: 10px;">Insurances: </h3>
		<a href="{{ action('CustomerInsurancesController@create', [$customer->id]) }}" style="text-align: center; margin-top: 1%;" class="btn addButton"> 
			<i>+ Add insurance </i>
		</a>
	</div>

	@unless ($customer->insurances->isEmpty())
		<table class="table table-hover cards-table">
			<thead id ="customerTHead">
				<tr>
					<th>Insurance Plan</th>
					<th>Provider</th>
					<th>Type</th>
					<th>Valid Until</th>
					@if (Auth::user()->isAdmin())
						<th></th>
					@endif
				</tr>
			</thead>
			<tbody>
			@foreach ($customer->insurances as $insurance)
				<tr id ="override">
					<td>{{ $insurance->name }}</td>
					<td><a href="{{ action('ProvidersController@show', [$insurance->provider->id]) }}" class="">{{ $insurance->provider->name }}</a></td>
					<td>{{ $insurance->insuranceType ? $insurance->insuranceType->name : '' }}</td>
					<td>{{ explode(' ', $insurance->pivot->valid_until)[0] }}</td>
					@if (Auth::user()->isAdmin())
						<td id ="buttonContainer">
							{!! Form::open(['method' => 'DELETE', 'action' => ['CustomerInsurancesController@destroy', $customer->id, $insurance->id], 'class' => 'deleteForm']) !!}
									{!! Form::submit('Remove', ['class' => 'btn btn-danger']) !!}
							{!! Form::close() !!}
						</td>
					@endif
				</tr>
			@endforeach
			</tbody>
		</table>
	@endunless

	<hr>
	<br />

	<div id ="add" class= "form-group" style="display: inline-flex; margin-bottom: 0;">
		<h3 style="width: initial; font-size: 36px; margin: 0; margin-bottom: -20px;">Requests: {{ $customer->total_requests }} </h3>
		&nbsp;
		<h4>( Early: {{ $count['early'] }} | Overdue: {{ $count['overdue'] }} | On Time: {{ $count['on time'] }} )</h4>
		<a href="{{ action('RequestsController@create', [$customer->id])}}" style="text-align: center; margin-top: 2%;" class="btn addButton"> 
			<i>+ Add Request </i>
		</a>
	</div>

	@include('requests._list')

	<hr>
@stop