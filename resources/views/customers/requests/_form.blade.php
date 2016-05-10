	
<link rel="stylesheet" href="/assets/css/add-edit.css">
		<fieldset class="form-group">
			{!! Form::label('insurance_id', 'Insurance:', ['class' => 'label-requests col-sm-3']) !!}
			{!! Form::select('insurance_id', $plans, isset($selected) ? $selected : 0, ['class' => 'form-control col-sm-9', 'id' => 'plan-select']) !!}
		</fieldset>

		<fieldset class="form-group">
			{!! Form::label('request_type_id', 'Request Type:', ['class' => 'label-requests col-sm-3']) !!}
			{!! Form::select('request_type_id', $types, isset($selType) ? $selType : 0, ['class' => 'form-control col-sm-9', 'id' => 'type-select']) !!}
		</fieldset>

		<fieldset class="form-group">
			{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary col-xs-offset-4']) !!}
		</fieldset>
		
		@section('footer')
			<script>
				$('#type-select').select2();
				$('#plan-select').select2();
			</script>
		@stop