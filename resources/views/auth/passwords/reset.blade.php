@extends('layouts.specialPage')

@section('title', '| Reset Password')

@section('content')
    <div class="peers ai-s fxw-nw h-100vh">
        <div class="d-n@sm- peer peer-greed h-100 pos-r bgr-n bgpX-c bgpY-c bgsz-cv" style="background-image:url({{ asset('assets/static/images/bg.jpg') }})">
            <div class="pos-a centerXY">
                <div class="bgc-white bdrs-50p pos-r" style="width:120px;height:120px"><img class="pos-a centerXY" src="{{ asset('assets/static/images/logo.png') }}" alt=""></div>
            </div>
        </div>
        <div class="col-12 col-md-4 peer pX-80 pY-80 h-100 bgc-white scrollable pos-r" style="min-width:320px">
            <h4 class="fw-300 c-grey-900 mB-40 text-center">Reset Password</h4>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                    <label for="email" class="text-normal text-dark">E-mail</label>
                    <input id="email" type="email" name="email" class="form-control" placeholder="E-mail" value="{{ old('email') }}" autofocus required>
                </div>
                <div class="form-group">
                    <label for="password" class="text-normal text-dark">Password</label>
                    <input id="password" type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="text-normal text-dark">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                </div>
                <div class="form-group mB-50">
                    @include('layouts.utils.errorMessages')
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-primary btn-block">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
@endsection
