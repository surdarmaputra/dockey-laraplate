<div class="row">
    <div class="col-md-6 col-sm-12">
        <h6 class="c-grey-800">Basic Information</h6>
        <div class="form-group row">
            {{ Form::label('name', 'Username', ['class' => 'col-sm-4 col-form-label']) }}
            <div class="col-sm-8">
                {{ Form::text('name', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="form-group row">
            {{ Form::label('email', 'Email', ['class' => 'col-sm-4 col-form-label']) }}
            <div class="col-sm-8">
                {{ Form::email('email', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <hr></hr>
        <h6 class="c-grey-800">Password</h6>
        <div class="form-group row">
            {{ Form::label('password', 'Password', ['class' => 'col-sm-4 col-form-label']) }}
            <div class="col-sm-8">
                {{ Form::password('password', ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="form-group row">
            {{ Form::label('password', 'Confirm Password', ['class' => 'col-sm-4 col-form-label']) }}
            <div class="col-sm-8">
                {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <h6 class="c-grey-800">Role Management</h6>
        <div class="form-group row">
            <div class="col-sm-4">
                Available Role(s)
                <small class="form-text text-muted">Check role(s) that will be assigned to user.</small>
            </div>
            <div class="col-sm-8">
                @forelse ($roles as $role)
                    <div class="form-check">
                        <label for="{{ $role->name }}" class="form-check-label">
                            {{ Form::checkbox('roles[]', $role->id, null, ['class' => 'form-check-input']) }}
                            {{ ucfirst($role->name) }}
                        </label>
                    </div>
                @empty
                    <div class="form-text text-muted">No role available yet.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@include('layouts.utils.errorMessages')