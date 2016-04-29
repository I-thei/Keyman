@extends('layouts.app')

<link rel="stylesheet" href="/assets/css/index.css">

@section('content')
		<br />
		<br />
		<img src="/assets/images/KeymanLogo2.png" style="height:100px; width: 110px">
		<h1><div class= "adjust">
<!-- <<<<<<< HEAD -->
<!-- 			<span style="color: rgb(232,131,52)">KEY<span style="color: rgb(23,92,114)">MAN</span></span><br />INSURANCE<br />SYSTEM -->
<!-- ======= -->
			<span style="color: rgb(233,130,51)">KEY<span style="color: rgb(0,77,139)">MAN</span></span><br />INSURANCE<br />SYSTEM
<!-- >>>>>>> 00dbeff3f1de52ccd0ff2081752ac8c14fe8d247 -->
		</div></h1>


		<div class="container_top_padding">
			<a href="{{ url('/login') }}"class=" btn btn-primary">LOG IN</a>
			<br />
			<a href="{{ url('/register') }}"class="btn btn-link">Register</a>
		</div>

@stop