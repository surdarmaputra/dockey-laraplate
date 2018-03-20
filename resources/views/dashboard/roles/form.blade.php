@include('layouts.utils.errorMessages')

<div class="form-group row">
    {{ Form::label('name', 'Role Name', ['class' => 'col-sm-4 col-form-label form-label--required']) }}
    <div class="col-sm-8">
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>
</div>
<div class="form-group row">
    {{ Form::label('display_name', 'Display Name', ['class' => 'col-sm-4 col-form-label']) }}
    <div class="col-sm-8">
        {{ Form::text('display_name', null, ['class' => 'form-control']) }}
    </div>
</div>
<div class="form-group row">
    {{ Form::label('description', 'Description', ['class' => 'col-sm-4 col-form-label']) }}
    <div class="col-sm-8">
        {{ Form::text('description', null, ['class' => 'form-control']) }}
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        Available Permission(s)
        <small class="form-text text-muted">Check permission(s) that will be assigned to role.</small>
    </div>
    <div class="col-sm-8">
        @forelse ($permissions as $permission)
            <div class="form-check">
                <label for="{{ $permission->name }}" class="form-check-label">
                    {{ Form::checkbox('permissions[]', $permission->id, null, ['class' => 'form-check-input']) }}
                    {{ ucfirst($permission->name) }}
                </label>
            </div>
        @empty
            <div class="form-text text-muted">No permission available yet.</div>
        @endforelse
    </div>
</div>