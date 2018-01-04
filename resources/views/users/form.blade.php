<div class="form-group">
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('email', 'Email') }}
    {{ Form::email('email', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    @foreach ($roles as $role)
        {{ Form::checkbox('roles[]', $role->id) }}
        {{ Form::label($role->name, ucfirst($role->name)) }}
    @endforeach
</div>
<div class="form-group">
    {{ Form::label('password', 'Password') }}
    {{ Form::password('password', ['class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('password', 'Confirm Password') }}
    {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
</div>

@include('layouts.utils.errorMessages')