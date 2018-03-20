@extends('layouts.dashboard')

@section('title', '| List of Users')

@section('content')
    <div class="container-fluid">
        <h4 class="c-grey-700 mT-10 mB-30">
            <i class="fa fa-users icon-left"></i>List of Users
            <div class="gap-10 peers pull-right">
                @if (isset($roles) && count($roles) > 0)
                    <div class="peer">
                        <form>
                            <select id="role-filter" class="form-control">
                                <option value="">Show All</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" {{ str_contains(url()->full(), $role->name) ? 'selected' : '' }}>{{ $role->display_name }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                @endif
                <div class="peer">
                    <a href="{{ route('users.create') }}" class="btn btn-outline-info">
                        <i class="fa fa-plus icon-left"></i>New User
                    </a>
                </div>
            </div>
        </h4>
        <div class="row">
            <div class="col-md-12">
                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <table id="dataTable" class="table table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Username</th>
                                <th>Full Name</th>
                                <th>Email</th>                        
                                <th>Roles</th>                        
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Photo</th>
                                <th>Username</th>
                                <th>Full Name</th>
                                <th>Email</th>                        
                                <th>Roles</th>                        
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach  ($users as $user)
                                <tr>
                                    <td style="text-align: center;">
                                        <img src="{{ $user->photo or asset('assets/static/images/no-profile.png') }}" width="35">
                                    </td>
                                    <td>{{ $user->username }}</td>           
                                    <td>{{ $user->full_name }}</td>
                                    <td>{{ $user->email }}</td>           
                                    <td>{{ $user->roles()->pluck('name')->implode(' ') }}</td>
                                    <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>           
                                    <td>
                                        <div class="gap-5 peers">
                                            <div class="peer">
                                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-info">Edit</a>
                                            </div>
                                            @if (!$user->built_in)
                                                <div class="peer">
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id] ]) !!}
                                                        <button class="btn btn-sm btn-outline-danger" onclick="confirmDeletion(event)">Delete</button>
                                                    {!! Form::close() !!}
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('layouts.utils.confirmDeletionScript')

@push('customScripts')
    <script>
        function redirect(event) {
            var role = event.target.value;
            window.location = "{{ route('users.index') }}?role=" + role;
        }

        var roleFilter = document.querySelector('#role-filter');
        if (typeof roleFilter !== 'undefined' || roleFilter !== null) addEventListener('change', redirect);
    </script>
@endpush