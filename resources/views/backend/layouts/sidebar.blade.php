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
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('categories.index')}}">
                <i class="bi bi-person"></i>
                <span>Categories</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('products.index')}}">
                <i class="bi bi-person"></i>
                <span>Products</span>
            </a>
             <a class="nav-link collapsed" href="{{route('banners.index')}}">
                <i class="bi bi-person"></i>
                <span>Banner</span>
            </a>
        </li>
        <!-- End Profile Page Nav  categories -->

        @endif
        @if(\Auth::user()->role == 'user')
        @endif

    </ul>

</aside>
