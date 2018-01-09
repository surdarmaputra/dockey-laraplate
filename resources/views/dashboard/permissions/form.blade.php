<div class="form-group row">
    {{ Form::label('name', 'Permission Name', ['class' => 'col-sm-4 col-form-label']) }}
    <div class="col-sm-8">
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>
</div>

@if (str_contains(url()->current(), 'permissions/create'))
    <div class="form-group row">
        @if(!$roles->isEmpty())
            <div class="col-sm-4">
                Available Role(s)
                <small class="form-text text-muted">Check role(s) that will be assigned permission.</small>
            </div>
            <div class="col-sm-8">
                @foreach ($roles as $role)
                    <div class="form-check">
                        <label for="{{ $role->name }}" class="form-check-label">
                            {{ Form::checkbox('roles[]', $role->id, null, ['class' => 'form-check-input']) }}
                            {{ ucfirst($role->name) }}
                        </label>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endif

@include('layouts.utils.errorMessages')