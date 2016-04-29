@extends('layouts.app')

<link rel="stylesheet" href="/assets/css/index.css">

@section('content')
		<br />
		<br />
		<img src="/assets/images/KeymanLogo2.png" style="height:100px; width: 110px">
		<h1><div class= "adjust">
			<span style="color: rgb(232,131,52)">KEY<span style="color: rgb(23,92,114)">MAN</span></span><br />INSURANCE<br />SYSTEM
		</div></h1>


		<div class="container_top_padding">
			<a href="{{ url('/login') }}"class=" btn btn-primary">LOG IN</a>
			<br />
			<a href="{{ url('/register') }}"class="btn btn-link">Register</a>
		</div>

@stop