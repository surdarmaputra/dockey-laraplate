@extends('layouts.dashboard')

@section('title', '| New Permission')

@section('content')
    <div class="col-lg-10">
        <h1><i class="fa fa-user-plus">New Permission</h1>
        {{ Form::open(['route' => ['permissions.index']]) }}
            @include('permissions.form')
            {{ Form::submit('Add', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}
    </div>
@endsection