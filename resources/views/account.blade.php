@extends('layouts.app')

<link rel="stylesheet" href="/assets/css/requests.css">
<link rel="stylesheet" href="/assets/css/tablecard.css">
<link rel="stylesheet" href="/assets/css/account.css">


@section('content')
<hr>
<b><h3>ACCOUNT</h3></b>
<br />
<div class="bgblue" style="display: inline-block;">
	<div style="margin:8px; width:50%; display: inline-flex;">
		<div>
			<div style="background-color: white; border-radius: 50%; width:76px;
				height:76px;font-size: 50px; color: rgb(233,130,51); text-align: center; font-family: 'Nav';line-height: 76px; margin: 10px;">
				{{ Auth::user()->name[0] }}
			</div>
		</div> 

		<div style="display:inline-table; float:left; margin: 10px;"><div class="upper" style="font-size: 18px"> {{ Auth::user()->name }} </div>
			{{ Auth::user()->email }}<br />
			{{ Auth::user()->phone_num }}<br />
			<a id="editButton" href ="{{ action('Auth\AuthController@edit', [Auth::user()->id])}}" style="color:rgb(233,130,51);height: 20px;">
				 EDIT ACCOUNT
			</a>
		</div>
	</div>
	<div style="margin-top: 5px; display: inline-block; float: right; width: 30px;z-index: 5;"></div>
</div>
@include('requests._list')
<hr>
@stop

