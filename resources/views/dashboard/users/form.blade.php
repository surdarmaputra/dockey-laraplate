@include('layouts.utils.errorMessages')

<div class="row">
    <div class="col-md-6 col-sm-12">
        <h6 class="c-grey-800">Basic Information</h6>
        <div class="form-group row">
            {{ Form::label('username', 'Username', ['class' => 'col-sm-4 col-form-label form-label--required']) }}
            <div class="col-sm-8">
                {{ Form::text('username', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="form-group row">
            {{ Form::label('full_name', 'Full Name', ['class' => 'col-sm-4 col-form-label form-label--required']) }}
            <div class="col-sm-8">
                {{ Form::text('full_name', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="form-group row">
            {{ Form::label('address', 'Address', ['class' => 'col-sm-4 col-form-label']) }}
            <div class="col-sm-8">
                {{ Form::text('address', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="form-group row">
            {{ Form::label('phone_number', 'Phone Number', ['class' => 'col-sm-4 col-form-label']) }}
            <div class="col-sm-8">
                {{ Form::text('phone_number', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="form-group row">
            {{ Form::label('email', 'Email', ['class' => 'col-sm-4 col-form-label form-label--required']) }}
            <div class="col-sm-8">
                {{ Form::email('email', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="form-group row">
            {{ Form::label('active', 'Status', ['class' => 'col-sm-4 col-form-label form-label--required']) }}
            <div class="col-sm-8">
                <div class="form-check">
                    <label for="active" class="form-check-label">
                        {{ Form::radio('active', 1, TRUE, ['class' => 'form-check-input']) }} 
                        Active
                    </label><br/>
                    <label for="active" class="form-check-label">
                        {{ Form::radio('active', 0, null, ['class' => 'form-check-input']) }} 
                        Inactive
                    </label>
                </div>
            </div>
        </div>
        <hr></hr>
        <h6 class="c-grey-800">Password</h6>
        <div class="form-group row">
            {{ Form::label('password', 'Password', ['class' => 'col-sm-4 col-form-label']) }}
            <div class="col-sm-6">
                {{ Form::password('password', ['class' => 'form-control']) }}
            </div>
            <div class="col-md-2">
                <button class="btn btn-default" onclick="event.preventDefault(); generatePassword();">Generate</button>
            </div>
        </div>
        <div class="form-group row">
            {{ Form::label('password', 'Password Confirmation', ['class' => 'col-sm-4 col-form-label']) }}
            <div class="col-sm-6">
                {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
                <br><input id="toggle-password" type="checkbox"> Show password
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <h6 class="c-grey-800">Role Management</h6>
        <div class="form-group row">
            <div class="col-sm-4">
                Roles
                <small class="form-text text-muted">Check roles to be assign to user.</small>
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
                    <div class="form-text text-muted">No role available.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@push('customScripts')
    <script src="{{ asset('supports/pikaday/pikaday.js') }}">
    </script>
    <script>
        function formatDate(date) {
            return date.getFullYear() + '-' + ('0' + (parseInt(date.getMonth()) + 1)).slice(-2) + '-' + ('0' + date.getDate()).slice(-2) + ' 00:00:00';
        }
        function randomizePassword() {
            var baseChars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            var result = '';
            for (var i = 0; i < 6; i++) {
                result += baseChars[Math.floor(baseChars.length * Math.random())]
            }
            return result;
        }
        function togglePassword(targetElement) {
            if (targetElement.type === 'password') targetElement.type = 'text';
            else if (targetElement.type === 'text') targetElement.type = 'password';
        }
        function resetTogglePassword() {
            var toggle = document.querySelector('#toggle-password');
            var password = document.querySelector('#password');
            if (password.type === 'password') toggle.checked = false;
            else if (password.type === 'text') toggle.checked = true;
        }
        function generatePassword() {
            var password = document.querySelector('#password');
            var confirmation = document.querySelector('input[name="password_confirmation"]');
            var generatedPassword = randomizePassword()
            password.value = confirmation.value = generatedPassword;
        }
        document.querySelector('#toggle-password').addEventListener('click', function() {
            togglePassword(document.querySelector('#password')); 
            togglePassword(document.querySelector('input[name="password_confirmation"]'));
        })
        resetTogglePassword();
        @if (!isset($user))
            generatePassword();
        @endif
    </script>
@endpush