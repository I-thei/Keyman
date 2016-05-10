<link rel="stylesheet" href="/assets/css/add-edit.css">
		<fieldset class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
			{!! Form::label('name', 'Name:', ['class' => 'label-requests col-sm-3']) !!}
			{!! Form::text('name', null, ['class' => 'form-control col-sm-9']) !!}
		</fieldset>
		<fieldset class="form-group"> 
			{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary col-xs-offset-4']) !!}
		</fieldset> 