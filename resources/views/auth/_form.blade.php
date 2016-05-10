<link rel="stylesheet" href="/assets/css/add-edit.css">
<fieldset class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label class="label-requests col-xs-3">Name:</label>
    {!! Form::text('name', null, ['class' => 'form-control col-sm-9']) !!}
    
</fieldset>

<fieldset class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label class="label-requests col-xs-3">Email:</label>
    {!! Form::email('email', null, ['class' => 'form-control col-sm-9']) !!}
</fieldset>

<fieldset class="form-group{{ $errors->has('phone_num') ? ' has-error' : '' }}">
    <label class="label-requests col-xs-3">Phone Number:</label>
    {!! Form::text('phone_num', null, ['class' => 'form-control col-sm-9']) !!}

</fieldset>

<fieldset class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    <label class="label-requests col-xs-3">{{ $passwordText }}</label>
    {!! Form::password('password', ['class' => 'form-control col-sm-9']) !!}
</fieldset>

<fieldset class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
    <label class="label-requests col-xs-3">Confirm Password:</label>
    {!! Form::password('password_confirmation', ['class' => 'form-control col-sm-9']) !!}
</fieldset>


<fieldset class="form-group"> 
    {!! Form::label('', '', ['class' => 'label-requests col-sm-6 col-sm-3 col-sm-offset-6']) !!}
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
</fieldset>