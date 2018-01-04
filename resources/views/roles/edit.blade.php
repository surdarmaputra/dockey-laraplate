@extends('layouts.app')

@section('title', '| Edit Role')

@section('content')
    <div class="col-lg-10">
        <h1><i class="fa fa-role-plus">Edit Role {{ $role->name }}</h1>
        {{ Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'PUT']) }}
            @include('roles.form')
            {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}
    </div>
@endsection