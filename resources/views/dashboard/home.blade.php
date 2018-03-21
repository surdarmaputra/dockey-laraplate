@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 bgc-white bd bdrs-3 p-20 text-center">
            <h1>Welcome!</h1>
            <p>
                <div>This is your dashboard view. Have a nice day <i class="fa fa-smile-o"></i></div>
                <div class="c-grey-600">Current time is <strong id="current-time">-:-:-</strong></div>
            </p>
        </div>
    </div>
</div>

@push('customScripts')
    <script>
        function setCurrentTime() {
            const now = new Date();
            const currentTimeElement = document.getElementById('current-time');
            currentTimeElement.innerHTML = ('0' + now.getHours()).slice(-2) + ':' + ( '0' + now.getMinutes() ).slice(-2) + ':' + ('0' + now.getSeconds()).slice(-2);
        }
    </script>
@endpush

@push('windowOnloadFunctions')
        setInterval(() => setCurrentTime(), 1000);
@endpush

@endsection
