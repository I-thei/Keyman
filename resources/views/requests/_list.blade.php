	@unless ($requests->isEmpty())
			<div id="requestTHeadSort" class="dropdown" style="vertical-align: bottom; float: right; margin-top: 30px;margin-bottom: 8px;margin-right: 8px;">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Sort<span class="caret"></span></a>
				<ul class="dropdown-menu dropdown-menu-right" role="menu">
					<li>
						@if ($sortby == 'id' && $order == 'asc') {!!
	                        link_to_action(
	                            $sortMethod,
	                            'Date Received',
	                            [
	                                isset($attach) ? $attach : null,
	                                'sortby' => 'id',
	                                'order' => 'desc',
	                            ]
	                        )
	                    !!}
	                    <i class="fa fa-caret-up" aria-hidden="true"></i>

	                    @elseif ($sortby == 'id' && $order == 'desc') {!!
	                        link_to_action(
	                            $sortMethod,
	                            'Date Received',
	                            [
	                                isset($attach) ? $attach : null,
	                                'sortby' => 'id',
	                                'order' => 'asc',
	                            ]
	                        )
	                    !!}
                    	<i class="fa fa-caret-down" aria-hidden="true"></i>
                    
	                    @else
	                     {!!
	                        link_to_action(
	                            $sortMethod,
	                            'Date Received',
	                            [
	                                isset($attach) ? $attach : null,
	                                'sortby' => 'id',
	                                'order' => 'asc',
	                            ]
	                        )
	                    !!}

                		@endif

                	</li>
						@if ($showCustomer)
							<li>
								@if ($sortby == 'customer' && $order == 'asc') {!!
			                        link_to_action(
			                            $sortMethod,
			                            'customer',
			                            [
			                                isset($attach) ? $attach : null,
			                                'sortby' => 'customer',
			                                'order' => 'desc',
			                            ]
			                        )
			                    !!}
			                    <i class="fa fa-caret-up" aria-hidden="true"></i>
			                    @elseif ($sortby == 'customer' && $order == 'desc') {!!
			                        link_to_action(
			                            $sortMethod,
			                            'customer',
			                            [
			                                isset($attach) ? $attach : null,
			                                'sortby' => 'customer',
			                                'order' => 'asc',
			                            ]
			                        )
			                    !!}
			                    <i class="fa fa-caret-down" aria-hidden="true"></i>
			                    @else
			                     {!!
			                        link_to_action(
			                            $sortMethod,
			                            'customer',
			                            [
			                                isset($attach) ? $attach : null,
			                                'sortby' => 'customer',
			                                'order' => 'asc',
			                            ]
			                        )
			                    !!}
			                	@endif
		                	</li>
						@endif

					<li>
						@if ($sortby == 'insurance' && $order == 'asc') {!!
		                     link_to_action(
		                            $sortMethod,
		                            'insurance',
		                            [
		                                isset($attach) ? $attach : null,
		                                'sortby' => 'insurance',
		                                'order' => 'desc',
		                            ]
		                        )
		                    !!}
		                    <i class="fa fa-caret-up" aria-hidden="true"></i>
	                    @elseif ($sortby == 'insurance' && $order == 'desc') {!!
	                        link_to_action(
	                            $sortMethod,
	                            'insurance',
	                            [
	                                isset($attach) ? $attach : null,
	                                'sortby' => 'insurance',
	                                'order' => 'asc',
	                            ]
	                        )
	                    !!}
	                    <i class="fa fa-caret-down" aria-hidden="true"></i>
	                    @else
	                     {!!
	                        link_to_action(
	                            $sortMethod,
	                            'insurance',
	                            [
	                                isset($attach) ? $attach : null,
	                                'sortby' => 'insurance',
	                                'order' => 'asc',
	                            ]
	                        )
		                !!}
		                @endif
					</li>

					<li>
						@if ($sortby == 'type' && $order == 'asc') 
							{!!
		                        link_to_action(
		                            $sortMethod,
		                            'Request',
		                            [
		                                isset($attach) ? $attach : null,
		                                'sortby' => 'type',
		                                'order' => 'desc',
		                            ]
		                        )
		                    !!}
	                    	<i class="fa fa-caret-up" aria-hidden="true"></i>
	                    @elseif ($sortby == 'type' && $order == 'desc') {!!
	                        link_to_action(
	                            $sortMethod,
	                            'Request',
	                            [
	                                isset($attach) ? $attach : null,
	                                'sortby' => 'type',
	                                'order' => 'asc',
	                            ]
	                        )
	                    !!}
	                    <i class="fa fa-caret-down" aria-hidden="true"></i>
	                    @else
	                     {!!
	                        link_to_action(
	                            $sortMethod,
	                            'Request',
	                            [
	                                isset($attach) ? $attach : null,
	                                'sortby' => 'type',
	                                'order' => 'asc',
	                            ]
	                        )
	                    !!}
	                    @endif
					</li>
					<li>
						@if ($sortby == 'turnaround' && $order == 'asc') {!!
		                     link_to_action(
		                            $sortMethod,
		                            '(ideal) turnaround',
		                            [
		                                isset($attach) ? $attach : null,
		                                'sortby' => 'turnaround',
		                                'order' => 'desc',
		                            ]
		                        )
		                    !!}
		                    <i class="fa fa-caret-up" aria-hidden="true"></i>
	                    @elseif ($sortby == 'turnaround' && $order == 'desc') {!!
	                        link_to_action(
	                            $sortMethod,
	                            '(ideal) turnaround',
	                            [
	                                isset($attach) ? $attach : null,
	                                'sortby' => 'turnaround',
	                                'order' => 'asc',
	                            ]
	                        )
	                    !!}
	                    <i class="fa fa-caret-down" aria-hidden="true"></i>
	                    @else
	                     {!!
	                        link_to_action(
	                            $sortMethod,
	                            '(ideal) turnaround',
	                            [
	                                isset($attach) ? $attach : null,
	                                'sortby' => 'turnaround',
	                                'order' => 'asc',
	                            ]
	                        )
	                    !!}
	                    @endif
					</li>
					@if ($showUser)
					<li>
						@if ($sortby == 'consultant' && $order == 'asc') {!!
		                     link_to_action(
		                            $sortMethod,
		                            'consultant',
		                            [
		                                isset($attach) ? $attach : null,
		                                'sortby' => 'consultant',
		                                'order' => 'desc',
		                            ]
		                        )
		                    !!}
		                    <i class="fa fa-caret-up" aria-hidden="true"></i>
		                    @elseif ($sortby == 'consultant' && $order == 'desc') {!!
		                        link_to_action(
		                            $sortMethod,
		                            'consultant',
		                            [
		                                isset($attach) ? $attach : null,
		                                'sortby' => 'consultant',
		                                'order' => 'asc',
		                            ]
		                        )
		                    !!}
		                    <i class="fa fa-caret-down" aria-hidden="true"></i>
		                    @else
		                     {!!
		                        link_to_action(
		                            $sortMethod,
		                            'consultant',
		                            [
		                                isset($attach) ? $attach : null,
		                                'sortby' => 'consultant',
		                                'order' => 'asc',
		                            ]
		                        )
		                    !!}
		                 @endif
					</li>
					@endif
					<li>
					@if ($sortby == 'status' && $order == 'asc') {!!
	                     link_to_action(
	                            $sortMethod,
	                            'status',
	                            [
	                                isset($attach) ? $attach : null,
	                                'sortby' => 'status',
	                                'order' => 'desc',
	                            ]
	                        )
	                    !!}
	                    <i class="fa fa-caret-up" aria-hidden="true"></i>
                    @elseif ($sortby == 'status' && $order == 'desc') {!!
                        link_to_action(
                            $sortMethod,
                            'status',
                            [
                                isset($attach) ? $attach : null,
                                'sortby' => 'status',
                                'order' => 'asc',
                            ]
                        )
                    	!!}
                    	<i class="fa fa-caret-down" aria-hidden="true"></i>
                    @else
	                    {!!
	                        link_to_action(
	                            $sortMethod,
	                            'status',
	                            [
	                                isset($attach) ? $attach : null,
	                                'sortby' => 'status',
	                                'order' => 'asc',
	                            ]
	                        )
	                    !!}
                	@endif
                	</li>
				</ul>
			</div>

		<table class="table table-hover cards-table" style="margin-top:20px">
			<thead id="requestTHead">
				<tr>
					<th style="width: 12%;">
					<br />
						@if ($sortby == 'id' && $order == 'asc') 
							<a href="{!! action(
		                    	$sortMethod,
		                            [
		                                isset($attach) ? $attach : null,
		                                'sortby' => 'id',
		                                'order' => 'desc',
		                            ]
		                        )
		                    !!}">Data Received <i class="fa fa-caret-up" aria-hidden="true"></i></a>

	                    @elseif($sortby == 'id' && $order == 'desc')
	                    	 <a href="{!!
		                        action(
		                            $sortMethod,
		                            [
		                                isset($attach) ? $attach : null,
		                                'sortby' => 'id',
		                                'order' => 'asc',
		                            ]
		                        )
		                    !!}">Data Received <i class="fa fa-caret-down" aria-hidden="true"></i></a>
	                    @else
	                    	<a href="{!! action(
		                            $sortMethod,
		                            [
		                                isset($attach) ? $attach : null,
		                                'sortby' => 'id',
		                                'order' => 'desc',
		                            ]
		                        )
		                    !!}"> Data Received </a>

	                	@endif
                	<br />
                	<br />
					</th>
						@if ($showCustomer)
							<th>
							@if ($sortby == 'customer' && $order == 'asc') 
								<a href="{!! action(
			                    	$sortMethod,
			                            [
			                                isset($attach) ? $attach : null,
			                                'sortby' => 'customer',
			                                'order' => 'desc',
			                            ]
			                        )
			                    !!}">Customer <i class="fa fa-caret-up" aria-hidden="true"></i></a>

			                    @elseif($sortby == 'customer' && $order == 'desc')
			                    	 <a href="{!!
				                        action(
				                            $sortMethod,
				                            [
				                                isset($attach) ? $attach : null,
				                                'sortby' => 'customer',
				                                'order' => 'asc',
				                            ]
				                        )
				                    !!}">Customer <i class="fa fa-caret-down" aria-hidden="true"></i></a>
			                    @else
			                    	<a href="{!! action(
				                            $sortMethod,
				                            [
				                                isset($attach) ? $attach : null,
				                                'sortby' => 'customer',
				                                'order' => 'desc',
				                            ]
				                        )
				                    !!}"> Customer </a>
		                	@endif
			                </th>
						@endif
					<th>
						@if ($sortby == 'insurance' && $order == 'asc') 
							<a href="{!! action(
		                    	$sortMethod,
		                            [
		                                isset($attach) ? $attach : null,
		                                'sortby' => 'insurance',
		                                'order' => 'desc',
		                            ]
		                        )
		                    !!}">insurance <i class="fa fa-caret-up" aria-hidden="true"></i></a>

	                    @elseif($sortby == 'insurance' && $order == 'desc')
	                    	 <a href="{!!
		                        action(
		                            $sortMethod,
		                            [
		                                isset($attach) ? $attach : null,
		                                'sortby' => 'insurance',
		                                'order' => 'asc',
		                            ]
		                        )
		                    !!}">insurance <i class="fa fa-caret-down" aria-hidden="true"></i></a>
	                    @else
	                    	<a href="{!! action(
		                            $sortMethod,
		                            [
		                                isset($attach) ? $attach : null,
		                                'sortby' => 'insurance',
		                                'order' => 'desc',
		                            ]
		                        )
		                    !!}">insurance </a>
	                	@endif
					</th>
					<th>
						@if ($sortby == 'type' && $order == 'asc') 
								<a href="{!! action(
			                    	$sortMethod,
			                            [
			                                isset($attach) ? $attach : null,
			                                'sortby' => 'type',
			                                'order' => 'desc',
			                            ]
			                        )
			                    !!}">Request <i class="fa fa-caret-up" aria-hidden="true"></i></a>

	                    @elseif($sortby == 'type' && $order == 'desc')
	                    	 <a href="{!!
		                        action(
		                            $sortMethod,
		                            [
		                                isset($attach) ? $attach : null,
		                                'sortby' => 'type',
		                                'order' => 'asc',
		                            ]
		                        )
		                    !!}">Request <i class="fa fa-caret-down" aria-hidden="true"></i></a>
	                    @else
	                    	<a href="{!! action(
		                            $sortMethod,
		                            [
		                                isset($attach) ? $attach : null,
		                                'sortby' => 'type',
		                                'order' => 'desc',
		                            ]
		                        )
		                    !!}">Request </a>
                		@endif
					</th>
					<th style="width: 16%">
						@if ($sortby == 'turnaround' && $order == 'asc') 
								<a href="{!! action(
			                    	$sortMethod,
			                            [
			                                isset($attach) ? $attach : null,
			                                'sortby' => 'turnaround',
			                                'order' => 'desc',
			                            ]
			                        )
			                    !!}">(ideal) turnaround <i class="fa fa-caret-up" aria-hidden="true"></i></a>

	                    @elseif($sortby == 'turnaround' && $order == 'desc')
	                    	 <a href="{!!
		                        action(
		                            $sortMethod,
		                            [
		                                isset($attach) ? $attach : null,
		                                'sortby' => 'turnaround',
		                                'order' => 'asc',
		                            ]
		                        )
		                    !!}">(ideal) turnaround <i class="fa fa-caret-down" aria-hidden="true"></i></a>
	                    @else
	                    	<a href="{!! action(
		                            $sortMethod,
		                            [
		                                isset($attach) ? $attach : null,
		                                'sortby' => 'turnaround',
		                                'order' => 'desc',
		                            ]
		                        )
		                    !!}">(ideal) turnaround </a>
                		@endif
					</th>
					@if ($showUser)
						<th style="width: 10%;">
							@if($sortby == 'consultant' && $order == 'asc') 
								<a href="{!! action(
			                    	$sortMethod,
			                            [
			                                isset($attach) ? $attach : null,
			                                'sortby' => 'consultant',
			                                'order' => 'desc',
			                            ]
			                        )
			                    !!}">consultant <i class="fa fa-caret-up" aria-hidden="true"></i></a>

		                    @elseif($sortby == 'consultant' && $order == 'desc')
		                    	 <a href="{!!
			                        action(
			                            $sortMethod,
			                            [
			                                isset($attach) ? $attach : null,
			                                'sortby' => 'consultant',
			                                'order' => 'asc',
			                            ]
			                        )
			                    !!}">consultant <i class="fa fa-caret-down" aria-hidden="true"></i></a>
		                    @else
		                    	<a href="{!! action(
			                            $sortMethod,
			                            [
			                                isset($attach) ? $attach : null,
			                                'sortby' => 'consultant',
			                                'order' => 'desc',
			                            ]
			                        )
			                    !!}">consultant </a>
	                		@endif
						</th>
					@endif
					<th>
						@if ($sortby == 'status' && $order == 'asc') 
							<a href="{!! action(
		                    	$sortMethod,
		                            [
		                                isset($attach) ? $attach : null,
		                                'sortby' => 'status',
		                                'order' => 'desc',
		                            ]
		                        )
		                    !!}">status <i class="fa fa-caret-up" aria-hidden="true"></i></a>

	                    @elseif($sortby == 'status' && $order == 'desc')
	                    	 <a href="{!!
		                        action(
		                            $sortMethod,
		                            [
		                                isset($attach) ? $attach : null,
		                                'sortby' => 'status',
		                                'order' => 'asc',
		                            ]
		                        )
		                    !!}">status <i class="fa fa-caret-down" aria-hidden="true"></i></a>
	                    @else
	                    	<a href="{!! action(
		                            $sortMethod,
		                            [
		                                isset($attach) ? $attach : null,
		                                'sortby' => 'status',
		                                'order' => 'desc',
		                            ]
		                        )
		                    !!}">status </a>
                		@endif

                	</th>
					<th>Progress</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			@foreach ($requests as $krequest)
				<tr id ="override">
					<td>{{ explode(' ',$krequest->created_at)[0] }}</td>
					@if ($showCustomer)
						<td style="text-align: left;"">
							<a href="{{ action('CustomersController@show', [$krequest->customer->id]) }}" class="">
								{{ $krequest->customer->fullNameMI }}
							</a>
						</td>
					@endif
					<td style="text-align: left;">{{ $krequest->insurance->name }}</td>
					<td style="text-transform: uppercase;">{{ $krequest->type ? $krequest->type->name : ''}}</td>
					<td>{{ explode(' ', $krequest->turnaround_date)[0] }}</td>
					@if ($showUser)
						<td><a href="{{ action('Auth\AuthController@show', [$krequest->users()->first()->id]) }}" class="">{{ $krequest->users()->first()->name }}</a></td>
					@endif
					<td>
						@if ($krequest->status == 'COMPLETED')
							<div style="color: green;">{{ $krequest->status }}</div>
						@elseif (Carbon\Carbon::now()->startOfDay()->gt($krequest->turnaround_date->startOfDay()))
							<div style="color: red;">{{ 'OVERDUE' }}</div>
						@elseif (Carbon\Carbon::now()->startOfDay()->eq($krequest->turnaround_date->startOfDay()))
							<div style="color: #ff5719">{{ 'URGENT' }}</div>
						@elseif ($krequest->status == 'PENDING')
							<div style="color: orange;">{{ $krequest->status }}</div>
						@elseif ($krequest->status == 'ONGOING')
								<div style="color: #00e2e2">{{ $krequest->status }}</div>
						@else
							{{ $krequest->status }}
						@endif
					</td>

					<td id="progressColumn">{{ $krequest->users()->first()->pivot->progress }} </td>
					<td id="buttoncontainer">
						@if (Auth::user()->isAdmin())
							<ul class="ulbutton"style="display: inline-flex; word-spacing: 3px; list-style: none;">
						@else
							<ul style="display: inline-flex; word-spacing: 3px; list-style: none;">
						@endif
						 
						@if ($krequest->status == 'ONGOING')
							{!! Form::open(['method' => 'PATCH', 'action' => ['RequestsController@update', $krequest->customer->id, $krequest->id], 'class' => 'updateForm', 'style' => 'margin-bottom:0;']) !!}
							<li>
								{!! Form::submit('Process', ['class' => 'btn btn-primary']) !!}
							</li>
							{!! Form::close() !!}
						@endif
		
						@if ($krequest->status == 'PENDING' && Auth::id() == $krequest->users()->first()->id)
						{!! Form::open(['method' => 'PATCH', 'action' => ['RequestsController@complete', $krequest->customer->id, $krequest->id], 'class' => 'completeForm', 'style' => 'margin-bottom:0;']) !!}
							<li> 
								{!! Form::submit('Complete', ['class' => 'btn btn-success']) !!}
							</li>
						{!! Form::close() !!}
						@endif

					@if (Auth::user()->isAdmin())
							{!! Form::open(['method' => 'DELETE', 'action' => ['RequestsController@destroy', $krequest->customer->id, $krequest->id], 'class' => 'deleteForm', 'style' => 'margin-bottom:0;']) !!}
								<li> 
									{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
								</li>
							{!! Form::close() !!}
						</ul>
					</td>
					@endif
				</tr>
			@endforeach
			</tbody>
		</table>
	@endunless

@section('footer')
	<script>
	    $(".updateForm").on("submit", function(){
	        return confirm("Do you want to process this request?");
	    });
	    $(".completeForm").on("submit", function(){
	        return confirm("Do you want to complete this request?");
	    });
	    $(".deleteForm").on("submit", function(){
	        return confirm("Do you want to delete this item?");
	    });

	    var tables = $('.cards-table');

			// Create an array containing all table headers
		var table_headers = [];
			tables.each(function() {
    			var th = [];
    			$(this).find('thead th').each(function() {
       			th.push($(this).text());
    		});
    	table_headers.push(th);

		});

	// Add a data-label attribute to each cell
	// with the value of the corresponding column header
	// Iterate through each table
		tables.each(function(table) {
    		var table_index = table;
    		// Iterate through each row
    		$(this).find('tbody tr').each(function() {
        	// Finally iterate through each column/cell
        		$(this).find('td').each(function(column) {
            	$(this).attr('data-label', table_headers[table_index][column]);
        		});
    		});
		});

	</script>
@stop