<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="{{ route('admin.index') }}">
        {{ __('Yönetim Panelim') }}
    </a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#!">
        <i class="bi bi-list"></i>
    </button>
    <a href="/" target="_blank" class="btn link-secondary d-flex align-items-center gap-1 me-auto">
        <i class="bi bi-box-arrow-in-up-right"></i>
        {{__('Siteye Git')}}
    </a>

    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link d-flex align-items-center gap-1" id="navbarDropdown" href="#" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-bounding-box fs-4"></i>
                {{ Auth::user()->name }} {{ Auth::user()->surname }}
                <i class="bi bi-chevron-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="dropdown-item" type="submit">
                            {{ __('Çıkış Yap') }}
                        </button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>
