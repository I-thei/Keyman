@extends('layouts.app')

@section('content')
	<h1>{{ $customer->first_name . ' ' . $customer->last_name . ', ' . $customer->middle_name }} <a href="{{ action('CustomersController@edit', [$customer->id])}}" class="btn btn-primary">Edit</a></h1>
	<hr>
		<content>
			{{ $customer->email }}
		<br>
			{{ $customer->phone_num }}
		</content>
	<br>
	<h5>Insurances: <a href="{{ action('CustomerInsurancesController@create', [$customer->id]) }}" class="btn btn-primary">Add</a> </h5>
	@unless ($customer->insurances->isEmpty())
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Name</th>
					<th>Provider</th>
					<th>Type</th>
					@if (Auth::user()->isAdmin())
					<th>Action</th>
					@endif
				</tr>
			</thead>
			@foreach ($customer->insurances as $insurance)
				<tr>
					<td>{{ $insurance->name }}</td>
					<td>{{ $insurance->provider->name }}</td>
					<td>{{ $insurance->insuranceType->name }}</td>
					@if (Auth::user()->isAdmin())
						<td>
							{!! Form::open(['method' => 'DELETE', 'action' => ['CustomerInsurancesController@destroy', $customer->id, $insurance->id], 'id' => 'deleteForm']) !!}
								<fieldset class="form-group"> 
									{!! Form::submit('Remove Insurance', ['class' => 'btn btn-danger']) !!}
								</fieldset>
							{!! Form::close() !!}
						</td>
					@endif
				</tr>
			@endforeach
		</table>
	@endunless

	<h5>Requests: {{ $customer->total_requests }} <a href="{{ action('RequestsController@create', [$customer->id])}}" class="btn btn-primary">Add</a></h5>
	@unless ($customer->requests->isEmpty())
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Date Received</th>
					<th>Insurance</th>
					<th>Type</th>
					<th>Turnaround Date</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			@foreach ($customer->requests as $krequest)
				<tr>
					<td>{{ explode(' ',$krequest->created_at)[0] }}</td>
					<td>{{ $krequest->insurance->name }}</td>
					<td>{{ $krequest->type->name }}</td>
					<td>{{ explode(' ',$krequest->turnaround_date)[0] }}</td>
					<td>{{ $krequest->status }}</td>
					<td>
						<a href="{{ action('RequestsController@edit', [$customer->id, $krequest->id]) }}" class="btn btn-primary">Process</a>
					</td>
				</tr>
			@endforeach
		</table>
	@endunless
@stop

@section('footer')
	<script>
	    $("#deleteForm").on("submit", function(){
	        return confirm("Do you want to delete this item?");
	    });
	</script>
@stop
