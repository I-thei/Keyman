@extends('layouts.app')

@section('content')
	<h1>Browse</h1>
	<hr>
	
	<fieldset class="form-group">
		{!! Form::label('customer', 'Search Customer:') !!}
		{!! Form::select('customer', $customers, null, ['class' => 'form-control', 'id' => 'customer-select']) !!}
		{!! Form::submit('Search Customer', ['class' => 'btn btn-primary']) !!}
	</fieldset>
	
	<fieldset class="form-group"> 
		{!! Form::label('provider', 'Search Provider:') !!}
		{!! Form::select('provider', $providers, null, ['class' => 'form-control', 'id' => 'provider-select']) !!}
		{!! Form::submit('Search Provider', ['class' => 'btn btn-primary']) !!}
	</fieldset>

	@section('footer')
		<script>
			$('#customer-select').select2();
			$('#provider-select').select2();
		</script>
	@stop
@stop