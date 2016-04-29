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
					<td>
						@if (Auth::user()->isAdmin())
							{!! Form::open(['method' => 'DELETE', 'action' => ['CustomerInsurancesController@destroy', $customer->id, $insurance->id], 'id' => 'deleteForm']) !!}
								<fieldset class="form-group"> 
									{!! Form::submit('Remove Insurance', ['class' => 'btn btn-danger']) !!}
								</fieldset>
							{!! Form::close() !!}
						@endif
					</td>
				</tr>
			@endforeach
		</table>
	@endunless

	<h5>Requests: {{ $customer->total_requests }}</h5>
	<ul>
		@foreach ($customer->requests as $request)
			<li>{{ $request->insurance }}</li>
			<li>{{ $request->type }}</li>
			<li>{{ $request->status }}</li>
		@endforeach
	</ul>
@stop

@section('footer')
	<script>
	    $("#deleteForm").on("submit", function(){
	        return confirm("Do you want to delete this item?");
	    });
	</script>
@stop