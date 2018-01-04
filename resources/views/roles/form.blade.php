<div class="form-group">
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    @foreach ($permissions as $permission)
        {{ Form::checkbox('permissions[]', $permission->id) }}
        {{ Form::label($permission->name, ucfirst($permission->name)) }}
    @endforeach
</div>

@include('layouts.utils.errorMessages')