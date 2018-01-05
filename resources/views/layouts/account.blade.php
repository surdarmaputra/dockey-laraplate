@if (Auth::guest())
    <li><a href="{{ route('login') }}">Login</a></li>
    <li><a href="{{ route('register') }}">Register</a></li>
@else
    <li class="dropdown">
        <a href="" class="dropdown-toggle no-after peers fxw-nw ai-c lh-1" data-toggle="dropdown">
            <div class="peer mR-10"><img class="w-2r bdrs-50p" src="https://randomuser.me/api/portraits/men/10.jpg" alt=""></div>
            <div class="peer">
                <span class="fsz-sm c-grey-900">
                    {{ Auth::user()->name }}
                </span>
            </div>
        </a>
        <ul class="dropdown-menu fsz-sm">
            <li><a href="" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i class="ti-user mR-10"></i> <span>Profile</span></a></li>
            <li role="separator" class="divider"></li>
            <li>
                <a class="d-b td-n pY-5 bgcH-grey-100 c-grey-700" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    <i class="ti-power-off mR-10"></i> <span>Logout</span>
                </a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </ul>
    </li>
@endif