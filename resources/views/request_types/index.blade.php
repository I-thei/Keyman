@extends('layouts.app')

<link rel="stylesheet" href="/assets/css/requests.css">
<link rel="stylesheet" href="/assets/css/tablecard-sm.css">

<style>

    li#adminButton{
        border-bottom-color: rgb(232,131,52);
        background-color: #f3f3f3;
    }

    li#reqTypesButton{
        background-color: #f3f3f3;
    }

</style>


@section('content')
	<hr>
		<h3 style=" margin-left: 5px;"  >Request Types</h3>
		    <div class = "form-group" style="text-align: center">
		    	<a href="{{ action('RequestTypesController@create' )}}" class="btn addButton">
		    		<i>+ Add Types  </i>
		    	</a>
		    </div>

	<table class="table table-hover cards-table" id ="small">
		<thead id="reqTypeTHead">
			<tr>
				<th>Request Type</th>
				<th>Ideal Turnaround</th>
				<th></th>
			</tr>
		</thead>

		@foreach ($types as $type)
			<tr id ="override">
				<td>{{ $type->name }}</td>
				<td>{{ $type->ideal_turnaround . ' day' }}{{ $type->ideal_turnaround == 1 ? '' : 's'}}</td>
				<td id ="buttonContainer">
					<a href="{{ action('RequestTypesController@edit', [$type->id]) }}" class="btn btn-primary">
						EDIT
					</a>
				</td>
			</tr>
		@endforeach
	</table>
	<hr>
@stop

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
		var table_headers = [];
			tables.each(function() {
    			var th = [];
    			$(this).find('thead th').each(function() {
       			th.push($(this).text());
    		});
    	table_headers.push(th);
		});

		tables.each(function(table) {
    		var table_index = table;
    		$(this).find('tbody tr').each(function() {
        		$(this).find('td').each(function(column) {
            	$(this).attr('data-label', table_headers[table_index][column]);
        		});
    		});
		});

	</script>
@stop