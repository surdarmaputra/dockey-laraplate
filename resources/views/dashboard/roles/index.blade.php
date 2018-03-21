@extends('layouts.dashboard')

@section('title', 'Roles')

@section('content')
    <div class="container-fluid">
        <h4 class="c-grey-900 mT-10 mB-30">
            <i class="fa fa-users icon-left"></i>Role Administration
            <a href="{{ route('roles.create') }}" class="btn btn-outline-info pull-right">
                <i class="fa fa-plus icon-left"></i>New Role
            </a>
        </h4>
        <div class="row">
            <div class="col-md-12">
                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <table id="dataTable" class="table table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Display Name</th>
                                <th>Permissions</th>                        
                                <th>Operations</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Display Name</th>
                                <th>Permissions</th>                        
                                <th>Operations</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach  ($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>        
                                    <td>{{ $role->display_name }}</td>   
                                    <td>{{ implode(', ', $role->permissions()->pluck('name')->toArray()) }}</td>           
                                    <td>
                                        <div class="gap-5 peers">
                                            <div class="peer">
                                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-outline-info">Edit</a>
                                            </div>
                                            @if (!$role->built_in)
                                                <div class="peer">
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id] ]) !!}
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