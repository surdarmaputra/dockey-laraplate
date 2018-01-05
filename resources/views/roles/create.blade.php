@extends('layouts.dashboard')

@section('title', '| New Role')

@section('content')
    <div class="col-lg-10">
        <h1><i class="fa fa-role-plus">New Role</h1>
        {{ Form::open(['route' => ['roles.index']]) }}
            @include('roles.form')
            {{ Form::submit('Add', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}
    </div>
@endsection