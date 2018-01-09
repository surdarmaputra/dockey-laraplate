@extends('layouts.specialPage')

@section('title', '| Login')

@section('content')
    <div class="peers ai-s fxw-nw h-100vh">
        <div class="d-n@sm- peer peer-greed h-100 pos-r bgr-n bgpX-c bgpY-c bgsz-cv" style="background-image:url({{ asset('assets/static/images/bg.jpg') }})">
            <div class="pos-a centerXY">
                <div class="bgc-white bdrs-50p pos-r" style="width:120px;height:120px"><img class="pos-a centerXY" src="{{ asset('assets/static/images/logo.png') }}" alt=""></div>
            </div>
        </div>
        <div class="col-12 col-md-4 peer pX-80 pY-80 h-100 bgc-white scrollable pos-r" style="min-width:320px">
            <h4 class="fw-300 c-grey-900 mB-40 text-center">Login</h4>
            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="email" class="text-normal text-dark">E-mail</label>
                    <input id="email" type="email" name="email" class="form-control" placeholder="E-mail" value="{{ old('email') }}" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password" class="text-normal text-dark">Password</label>
                    <input id="password" type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <div class="checkbox checkbox-info peers ai-c">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked': '' }} class="peer">
                        <label for="inputCall1" class="peers peer-greed js-sb ai-c"><span class="peer peer-greed">Remember Me</span></label>
                    </div>
                </div>
                <div class="form-group">
                    @include('layouts.utils.errorMessages')
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-primary btn-block">Log Me In</button>
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        Forgot Your Password?
                    </a>
                </div>
                <div class="form-group text-center mT-50">
                    <div>
                        Don't have account? 
                        <a class="btn btn-link" href="{{ route('register') }}">Register</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
