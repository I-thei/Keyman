        <fieldset class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </fieldset>
            
        <fieldset class="form-group">
            {!! Form::label('location', 'Location:') !!}
            {!! Form::text('location', null, ['class' => 'form-control']) !!}
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