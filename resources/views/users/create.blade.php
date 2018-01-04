@extends('layouts.app')

@section('title', '| New User')

@section('content')
    <div class="col-lg-10">
        <h1><i class="fa fa-user-plus">New User</h1>
        {{ Form::open(['route' => ['users.index']]) }}
            @include('users.form')
            {{ Form::submit('Add', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}
    </div>
@endsection