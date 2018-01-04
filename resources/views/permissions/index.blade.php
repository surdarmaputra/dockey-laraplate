@extends('layouts.app')

@section('title', '| Users')

@section('content')
    <div class="col-lg-10">
        <h1>
            <i class="fa fa-key">Available Permissions
            <a href="{{ route('users.index') }}" class="btn btn-default pull-right">Users</a>
            <a href="{{ route('roles.index') }}" class="btn btn-default pull-right">Roles</a>
        </h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Permission</th>
                        <th>Operations</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach  ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>           
                            <td>
                                <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id] ]) !!}
                                   {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('permissions.create') }}" class="btn btn-success">New Permission</a>
        </div>
    </div>
@endsection