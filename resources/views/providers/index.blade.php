@extends('layouts.app')

@section('content')
	<h1>Providers 
	@if (Auth::user()->isAdmin())
		<a href="{{ action('ProvidersController@create')}}" class="btn btn-primary">Add</a>
	@endif
	</h1>
	<hr>
	@foreach ($providers as $provider)
		<article>
			<h3>
			<a href="{{ action('ProvidersController@show', [$provider->id]) }}">{{ $provider->name }}</a>
			</h3>
		</article>
	@endforeach
@stop