@extends('layouts.app')

@section('title', '| Roles')

@section('content')
    <div class="col-lg-10">
        <h1>
            <i class="fa fa-roles">Role Administration
            <a href="{{ route('users.index') }}" class="btn btn-default pull-right">Users</a>
            <a href="{{ route('permissions.index') }}" class="btn btn-default pull-right">Permissions</a>
        </h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Role</th>
                        <th>Permissions</th>                        
                        <th>Operations</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach  ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>           
                            <td>{{ implode(', ', $role->permissions()->pluck('name')->toArray()) }}</td>           
                            <td>
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id] ]) !!}
                                   {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('roles.create') }}" class="btn btn-success">New Role</a>
        </div>
    </div>
@endsection