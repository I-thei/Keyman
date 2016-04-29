		<fieldset class="form-group">
			{!! Form::label('type', 'Type:') !!}
			{!! Form::select('type', $types, isset($selected) ? $selected : 0, ['class' => 'form-control', 'id' => 'type-select']) !!}
		</fieldset>

		<fieldset class="form-group">
			{!! Form::label('name', 'Plan:') !!}
			{!! Form::select('name', $providers, isset($selPlan) ? $selPlan : 0, ['class' => 'form-control', 'id' => 'plan-select']) !!}
		</fieldset>

		<fieldset class="form-group"> 
			{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
		</fieldset>

		@section('footer')
			<script>
				$('#type-select').select2();
				$('#plan-select').select2();
				//if #type-select is not 0, enable #plan-select
			</script>
		@stop