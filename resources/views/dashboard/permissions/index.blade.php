@extends('layouts.dashboard')

@section('title', '| Permissions')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <h4 class="c-grey-900 mT-10 mB-30">
                    <i class="fa fa-key icon-left"></i>Available Permissions
                </h4>
                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <table id="dataTable" class="table table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Display Name</th>
                                <th>Operations</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Display Name</th>
                                <th>Operations</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach  ($permissions as $key => $permission)
                                <tr>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->display_name }}</td>  
                                    <td>
                                        <div class="gap-5 peers">
                                            <div class="peer">
                                                <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-sm btn-outline-info">Edit</a>
                                            </div>
                                            @if (!$permission->built_in)
                                                <div class="peer">
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id] ]) !!}
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