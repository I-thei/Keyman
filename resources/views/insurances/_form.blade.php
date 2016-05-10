<link rel="stylesheet" href="/assets/css/add-edit.css">
		<fieldset class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
			{!! Form::label('name', 'Name:', ['class' => 'label-requests col-sm-3']) !!}
			{!! Form::text('name', null, ['class' => 'col-sm-9 form-control']) !!}
		</fieldset>

		<fieldset class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
			{!! Form::label('type', 'Type:', ['class' => 'label-requests col-sm-3']) !!}
			{!! Form::select('type', $types, isset($selected) ? $selected : 0, ['class' => 'col-sm-9 form-control','id' => 'type-select']) !!}
		</fieldset>
		
		<fieldset class="form-group{{ $errors->has('payment') ? ' has-error' : '' }}">
			{!! Form::label('payment', 'Price:', ['class' => 'label-requests col-sm-3']) !!}
			{!! Form::input('number', 'payment', $insurance->payment ? $insurance->payment : 0.00, ['class' => 'col-sm-9 form-control', 'step' => '0.01']) !!}
		</fieldset>

		<fieldset class="form-group">
			{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary col-xs-offset-4']) !!}
		</fieldset>
		
		@section('footer')
			<script>
				$('#type-select').select2();
				$(".select2-selection").addClass("form-control");
			    $(".deleteForm").on("submit", function(){
			        if (confirm("Do you want to delete this Insurance?")) {
			        	if(confirm("Are you sure? This will delete the insurance from customers' records. It will also delete the requests made for this insurance.")) {
			        		return(confirm("For the last time, are you sure you want to delete this?"));
			        	};
			        };
			        return false;
			    });
			</script>
		@stop