@extends('layouts.app')

@section('title', '| Users')

@section('content')
    <div class="col-lg-10">
        <h1>
            <i class="fa fa-users">User Administration
            <a href="{{ route('roles.index') }}" class="btn btn-default pull-right">Roles</a>
        </h1>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>                        
                        <th>Date/Time Added</th>                        
                        <th>User Roles</th>                        
                        <th>Operations</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach  ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>           
                            <td>{{ $user->email }}</td>           
                            <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>           
                            <td>{{ $user->roles()->pluck('name')->implode(' ') }}</td>           
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id] ]) !!}
                                   {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('users.create') }}" class="btn btn-success">New User</a>
        </div>
    </div>
@endsection