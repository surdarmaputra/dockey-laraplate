@extends('layouts.dashboard')

@section('title', 'New Role')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <h4 class="c-grey-700 mT-10 mB-30">
                    <i class="fa fa-user-plus icon-left"></i>New Role
                    <a href="{{ route('roles.index') }}" class="btn btn-outline-primary pull-right">
                        <i class="fa fa-list icon-left"></i>List of Roles
                    </a>
                </h4>
                <div class="bgc-white p-20 bd">
                    <div class="mT-30">
                        {{ Form::open(['route' => ['roles.index']]) }}
                            @include('dashboard.roles.form')
                            <div class="row gap-50">
                                <div class="col-md-12">
                                    <div class="gap-10 peers">
                                        <div class="peer">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fa fa-plus icon-left"></i>
                                                Save Role
                                            </button>
                                        </div>
                                        <div class="peer">
                                            <a class="btn btn-light" href="{{ route('roles.index') }}">
                                                <i class="fa fa-arrow-left icon-left"></i>
                                                Cancel
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection