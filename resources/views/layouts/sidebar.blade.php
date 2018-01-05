<ul class="sidebar-menu scrollable pos-r">
    <li class="nav-item mT-30 {{ (url()->current() === url('dashboard')) ? 'active' : '' }}">
        <a class="sidebar-link" href="{{ url('/dashboard') }}" default>
            <span class="icon-holder"><i class="c-blue-500 ti-home"></i> </span><span class="title">Dashboard</span>
        </a>
    </li>
    <li class="nav-item dropdown {{ str_contains(url()->current(), 'user-administrations') ? 'active open' : '' }}">
        <a class="dropdown-toggle" href="javascript:void(0);">
            <span class="icon-holder"><i class="c-orange-500 ti-layout-list-thumb"></i> </span><span class="title">User Administration</span> <span class="arrow"><i class="ti-angle-right"></i></span>
        </a>
        <ul class="dropdown-menu">
            <li class="nav-item {{ str_contains(url()->current(), 'user-administrations/users') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('users.index') }}">Users</a>
            </li>
            <li class="nav-item {{ str_contains(url()->current(), 'user-administrations/roles') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('roles.index') }}">Roles</a>
            </li>
            <li class="nav-item {{ str_contains(url()->current(), 'user-administrations/permissions') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('permissions.index') }}">Permissions</a>
            </li>
        </ul>
    </li>
    <li class="nav-item dropdown"><a class="dropdown-toggle" href="javascript:void(0);"><span class="icon-holder"><i class="c-teal-500 ti-view-list-alt"></i> </span><span class="title">Multiple Levels</span> <span class="arrow"><i class="ti-angle-right"></i></span></a>
        <ul class="dropdown-menu">
            <li class="nav-item dropdown"><a href="javascript:void(0);"><span>Menu Item</span></a></li>
            <li class="nav-item dropdown"><a href="javascript:void(0);"><span>Menu Item</span> <span class="arrow"><i class="ti-angle-right"></i></span></a>
                <ul class="dropdown-menu">
                    <li><a href="javascript:void(0);">Menu Item</a></li>
                    <li><a href="javascript:void(0);">Menu Item</a></li>
                </ul>
            </li>
        </ul>
    </li>
</ul>