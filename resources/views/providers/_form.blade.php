<link rel="stylesheet" href="/assets/css/add-edit.css">

        <fieldset class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            {!! Form::label('name', 'Name:', ['class' => 'label-requests col-sm-3']) !!}
            {!! Form::text('name', null, ['class' => 'col-sm-9 form-control']) !!}
        </fieldset>
            
        <fieldset class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
            {!! Form::label('location', 'Location:', ['class' => 'label-requests col-sm-3']) !!}
            {!! Form::text('location', null, ['class' => 'col-sm-9 form-control']) !!}
        </fieldset>
            
        <fieldset class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            {!! Form::label('email', 'Email:', ['class' => 'label-requests col-sm-3']) !!}
            {!! Form::email('email', null, ['class' => 'col-sm-9 form-control']) !!}
        </fieldset>
            
        <fieldset class="form-group{{ $errors->has('phone_num') ? ' has-error' : '' }}">
            {!! Form::label('phone_num', 'Phone Number:', ['class' => 'label-requests col-sm-3']) !!}
            {!! Form::text('phone_num', null, ['class' => 'col-sm-9 form-control']) !!}
        </fieldset>
            
        <fieldset class="form-group"> 
            {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary col-xs-offset-4']) !!}
        </fieldset>