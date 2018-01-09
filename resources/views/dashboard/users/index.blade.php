@extends('layouts.dashboard')

@section('title', '| Users')

@section('content')
    <div class="container-fluid">
        <h4 class="c-grey-700 mT-10 mB-30">
            <i class="fa fa-users icon-left"></i>User Administration
            <a href="{{ route('users.create') }}" class="btn btn-outline-primary pull-right">
                <i class="fa fa-plus icon-left"></i>New User
            </a>
        </h4>
        <div class="row">
            <div class="col-md-12">
                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <table id="dataTable" class="table table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>                        
                                <th>Date/Time Added</th>                        
                                <th>User Roles</th>                        
                                <th>Operations</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>                        
                                <th>Date/Time Added</th>                        
                                <th>User Roles</th>                        
                                <th>Operations</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach  ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>           
                                    <td>{{ $user->email }}</td>           
                                    <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>           
                                    <td>{{ $user->roles()->pluck('name')->implode(' ') }}</td>           
                                    <td>
                                        <div class="gap-5 peers">
                                            <div class="peer">
                                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-info">Edit</a>
                                            </div>
                                            <div class="peer">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id] ]) !!}
                                                    {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-outline-danger']) !!}
                                                 {!! Form::close() !!}
                                            </div>
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