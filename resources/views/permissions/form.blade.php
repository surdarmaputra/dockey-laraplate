<div class="form-group">
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', null, ['class' => 'form-control']) }}
</div>

@if (str_contains(url()->current(), 'permissions/create'))
    <div class="form-group">
        @if(!$roles->isEmpty())
            <h4>Assign Permission to Roles</h4>
            @foreach ($roles as $role)
                {{ Form::checkbox('roles[]', $role->id) }}
                {{ Form::label($role->name, ucfirst($role->name)) }}
            @endforeach
        @endif
    </div>
@endif

@include('layouts.utils.errorMessages')