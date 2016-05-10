	<link rel="stylesheet" href="/assets/css/add-edit.css">
	<style type="text/css">
		@media(max-width: 767px){
			.label-requests {
			    text-align: left;
			}
		}
		@media(min-width: 768px){
			.form-control {
			    font-family: 'Nav';
			    width: 60%;
			}
		}
	</style>
		<fieldset class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
			{!! Form::label('name', 'Name:', ['class' => 'label-requests col-sm-4']) !!}
			{!! Form::text('name', null, ['class' => 'col-sm-8 form-control']) !!}
		</fieldset>

		<fieldset class="form-group{{ $errors->has('ideal_turnaround') ? ' has-error' : '' }}">
			{!! Form::label('ideal_turnaround', 'Ideal Turnaround (days):', ['class' => 'label-requests col-sm-4']) !!}
			{!! Form::input('number', 'ideal_turnaround', $type->ideal_turnaround ? $type->ideal_turnaround : 1, ['class' => 'col-sm-8 form-control']) !!}
		</fieldset>

		<fieldset class="form-group"> 
			{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary col-xs-offset-4']) !!}
		</fieldset>