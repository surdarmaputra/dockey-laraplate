@extends('layouts.app')

@section('title', '| Edit User')

@section('content')
    <div class="col-lg-10">
        <h1><i class="fa fa-user-plus">Edit User {{ $user->name }}</h1>
        {{ Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT']) }}
            @include('users.form')
            {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}
    </div>
@endsection