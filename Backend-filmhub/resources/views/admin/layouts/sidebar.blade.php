<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseShift"
            aria-expanded="true" aria-controls="collapseShift">
            <i class="fas fa-fw fa-cog"></i>
            <span>Shift Manage</span>
        </a>
        <div id="collapseShift" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
{{--                <h6 class="collapse-header">Custom Components:</h6>--}}
<a class="collapse-item" href="{{ route('admin.shifts.index') }}">List</a>
<a class="collapse-item" href="{{ route('admin.shifts.create') }}">Create New</a>  
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
           aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Quản lý sản phẩm</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Danh sách chức năng</h6>
                <a class="collapse-item" href="">Danh sách</a>
                <a class="collapse-item" href="">Thêm</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrders"
           aria-expanded="true" aria-controls="collapseOrders">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Quản lý đơn hàng</span>
        </a>
        <div id="collapseOrders" class="collapse" aria-labelledby="headingOrders"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Danh sách chức năng</h6>
                <a class="collapse-item" href="">Danh sách</a>

            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers"
           aria-expanded="true" aria-controls="collapseUsers">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Manage Users</span>
        </a>
        <div id="collapseUsers" class="collapse" aria-labelledby="headingOrders"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">List function</h6>
                <a class="collapse-item" href="{{ route('users.index') }}">List users</a>
                

            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseVourchers"
           aria-expanded="true" aria-controls="collapseVourchers">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Manage Vourchers</span>
        </a>
        <div id="collapseVourchers" class="collapse" aria-labelledby="headingOrders"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">List function</h6>
                <a class="collapse-item" href="{{ route('vourchers.index') }}">List Vourchers</a>
                

            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseShowtimes"
           aria-expanded="true" aria-controls="collapseShowtimes">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Manage showtimes</span>
        </a>
        <div id="collapseShowtimes" class="collapse" aria-labelledby="headingOrders"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">List function</h6>
                <a class="collapse-item" href="{{ route('showtimes.index') }}">List showtimes</a>
                

            </div>
        </div>
    </li>

{{--    <!-- Divider -->--}}
{{--    <hr class="sidebar-divider">--}}

{{--    <!-- Heading -->--}}
{{--    <div class="sidebar-heading">--}}
{{--        Addons--}}
{{--    </div>--}}

{{--    <!-- Nav Item - Pages Collapse Menu -->--}}
{{--    <li class="nav-item">--}}
{{--        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"--}}
{{--           aria-expanded="true" aria-controls="collapsePages">--}}
{{--            <i class="fas fa-fw fa-folder"></i>--}}
{{--            <span>Pages</span>--}}
{{--        </a>--}}
{{--        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">--}}
{{--            <div class="bg-white py-2 collapse-inner rounded">--}}
{{--                <h6 class="collapse-header">Login Screens:</h6>--}}
{{--                <a class="collapse-item" href="login.html">Login</a>--}}
{{--                <a class="collapse-item" href="register.html">Register</a>--}}
{{--                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>--}}
{{--                <div class="collapse-divider"></div>--}}
{{--                <h6 class="collapse-header">Other Pages:</h6>--}}
{{--                <a class="collapse-item" href="404.html">404 Page</a>--}}
{{--                <a class="collapse-item" href="blank.html">Blank Page</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </li>--}}

{{--    <!-- Nav Item - Charts -->--}}
{{--    <li class="nav-item">--}}
{{--        <a class="nav-link" href="charts.html">--}}
{{--            <i class="fas fa-fw fa-chart-area"></i>--}}
{{--            <span>Charts</span></a>--}}
{{--    </li>--}}

{{--    <!-- Nav Item - Tables -->--}}
{{--    <li class="nav-item">--}}
{{--        <a class="nav-link" href="tables.html">--}}
{{--            <i class="fas fa-fw fa-table"></i>--}}
{{--            <span>Tables</span></a>--}}
{{--    </li>--}}

{{--    <!-- Divider -->--}}
{{--    <hr class="sidebar-divider d-none d-md-block">--}}

{{--    <!-- Sidebar Toggler (Sidebar) -->--}}
{{--    <div class="text-center d-none d-md-inline">--}}
{{--        <button class="rounded-circle border-0" id="sidebarToggle"></button>--}}
{{--    </div>--}}

{{--    <!-- Sidebar Message -->--}}
{{--    <div class="sidebar-card d-none d-lg-flex">--}}
{{--        <img class="sidebar-card-illustration mb-2" src="{{asset('theme/admin/img/undraw_rocket.svg')}}" alt="...">--}}
{{--        <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!--}}
{{--        </p>--}}
{{--        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>--}}
{{--    </div>--}}

</ul>
