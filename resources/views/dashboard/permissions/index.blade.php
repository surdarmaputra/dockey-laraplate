@extends('layouts.dashboard')

@section('title', '| Users')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <h4 class="c-grey-900 mT-10 mB-30">
                    <i class="fa fa-key icon-left"></i>Available Permissions
                    <a href="{{ route('permissions.create') }}" class="btn btn-outline-primary pull-right">
                        <i class="fa fa-plus icon-left"></i>New Permission
                    </a>
                </h4>
                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <table id="dataTable" class="table table-bordered table-hover" cellspacing="0" width="100%">
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
                                        <div class="gap-5 peers">
                                            <div class="peer">
                                                <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-sm btn-outline-info">Edit</a>
                                            </div>
                                            <div class="peer">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id] ]) !!}
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