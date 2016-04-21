		<fieldset class="form-group">
			
			{!! Form::label('name', 'Name:') !!}
			{!! Form::text('name', null, ['class' => 'form-control']) !!}
		</fieldset>
		<fieldset class="form-group">
			
			{!! Form::label('type', 'Type:') !!}
			{!! Form::select('type', $types, null, ['class' => 'form-control', 'id' => 'type-select']) !!}
		</fieldset>
		<fieldset class="form-group"> 
			
			{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
		</fieldset>

		@section('footer')
			<script>
				$('#type-select').select2({
					// placeholder: "*Select a Type*",
	  		// 		allowClear: false
				});
			</script>
		@stop