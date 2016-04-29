		<fieldset class="form-group">
			{!! Form::label('first_name', 'First Name:') !!}
			{!! Form::text('first_name', null, ['class' => 'form-control']) !!}
		</fieldset>

		<fieldset class="form-group">
			{!! Form::label('last_name', 'Last Name:') !!}
			{!! Form::text('last_name', null, ['class' => 'form-control']) !!}
		</fieldset>

		<fieldset class="form-group">
			{!! Form::label('middle_name', 'Middle Name:') !!}
			{!! Form::text('middle_name', null, ['class' => 'form-control']) !!}
		</fieldset>

		<fieldset class="form-group">
			{!! Form::label('email', 'Email:') !!}
			{!! Form::email('email', null, ['class' => 'form-control']) !!}
		</fieldset>

		<fieldset class="form-group">
			{!! Form::label('phone_num', 'Phone Number:') !!}
			{!! Form::text('phone_num', null, ['class' => 'form-control']) !!}
		</fieldset>
		
		<fieldset class="form-group"> 
			{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
		</fieldset>