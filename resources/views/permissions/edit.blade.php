@extends('layouts.dashboard')

@section('title', '| Edit Permission')

@section('content')
    <div class="col-lg-10">
        <h1><i class="fa fa-permission-plus">Edit Permission {{ $permission->name }}</h1>
        {{ Form::model($permission, ['route' => ['permissions.update', $permission->id], 'method' => 'PUT']) }}
            @include('permissions.form')
            {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}
    </div>
@endsection