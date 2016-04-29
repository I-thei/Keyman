@extends('layouts.app')

@section('content')
	<h1>{{ $provider->name }} 
	@if (Auth::user()->isAdmin())
		<a href="{{ action('ProvidersController@edit', [$provider->id]) }}" class="btn btn-primary">Edit</a>
	@endif
	</h1>
	<hr>
		<content>
			{{ $provider->location }}
		<br>
			{{ $provider->email }}
		<br>
			{{ $provider->phone_num }}
		</content>
	<br>
	<h5>Insurance Plans: <a href="{{ action('InsurancesController@create', [$provider->id]) }}" class="btn btn-primary">Add</a> </h5>
	@unless ($provider->insurances->isEmpty())
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Name</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			@foreach ($provider->insurances as $insurance)
				<tr>
					<td>{{ $insurance->name }}</td>
					<td>{{ $insurance->insuranceType->name }}</td>
					<td><a href="{{ action('InsurancesController@edit', [$provider->id, $insurance->id]) }}" class="btn btn-primary">Edit</a></td>
				</tr>
			@endforeach
		</table>
	@endunless
@stop