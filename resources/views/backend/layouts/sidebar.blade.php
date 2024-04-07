<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        @if(\Auth::user()->role == 'admin')
        <li class="nav-item">
            <a class="nav-link " href="{{asset('dashboard')}}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('users.index')}}">
                <i class="bi bi-person"></i>
                <span>Users</span>
            </a>
        </li><!-- End Profile Page Nav -->

        @endif
        @if(\Auth::user()->role == 'user')
        @endif

    </ul>

</aside>
