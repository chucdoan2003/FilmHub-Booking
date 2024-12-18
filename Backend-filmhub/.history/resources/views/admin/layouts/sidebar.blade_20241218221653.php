@if (Auth::check())

    @php
        $user = Auth::user(); // Lấy thông tin người dùng hiện tại
        $theaterName = null;

        // Kiểm tra nếu user có theater_id
        if (!is_null($user->theater_id)) {
            $theater = \DB::table('theaters')
                ->where('theater_id', $user->theater_id)
                ->first();
            $theaterName = $theater ? $theater->name : null;
        }
    @endphp
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->

        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-2">
                {{ "Rạp ". $theaterName ?? 'SB Admin' }}
            </div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        {{-- <li class="nav-item active">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li> --}}

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        @if (Auth::user()->status == 'admin')
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse1"
                    aria-expanded="true" aria-controls="collapse1">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Quản lý rạp chiếu</span>
                </a>
                <div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                        <a class="collapse-item" href="{{ route('admin.theaters.index') }}">Danh sách</a>

                        <a class="collapse-item" href="{{ route('theaters.indexRoom') }}">Danh sách phòng</a>


                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMovies"
                    aria-expanded="true" aria-controls="collapseMovies">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Quản lý phim</span>
                </a>
                <div id="collapseMovies" class="collapse" aria-labelledby="headingMovies"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Danh sách phim</h6>
                        <a class="collapse-item" href="{{ route('admin.movies.index') }}">Danh sách</a>
                        <a class="collapse-item" href="{{ route('admin.movies.create') }}">Tạo mới</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGenre"
                    aria-expanded="true" aria-controls="collapseGenre">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Quản lý thể loại</span>
                </a>
                <div id="collapseGenre" class="collapse" aria-labelledby="headingMovies"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Danh sách chức năng</h6>
                        <a class="collapse-item" href="{{ route('admin.genres.index') }}">Danh sách</a>
                        <a class="collapse-item" href="{{ route('admin.genres.create') }}">Tạo mới</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCombos"
                    aria-expanded="true" aria-controls="collapseCombos">
                    <i class="fas fa-fw fa-concierge-bell"></i>
                    <span>Quản lý Combo</span>
                </a>
                <div id="collapseCombos" class="collapse" aria-labelledby="headingCombos"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Danh sách chức năng</h6>
                        <a class="collapse-item" href="{{ route('admin.combos.index') }}">Danh sách</a>
                        <a class="collapse-item" href="{{ route('admin.combos.create') }}">Tạo mới</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFoods"
                    aria-expanded="true" aria-controls="collapseFoods">
                    <i class="fas fa-fw fa-concierge-bell"></i>
                    <span>Quản lý Đồ Ăn</span>
                </a>
                <div id="collapseFoods" class="collapse" aria-labelledby="headingFoods" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Danh sách chức năng</h6>
                        <a class="collapse-item" href="{{ route('admin.foods.index') }}">Danh sách Thức Ăn</a>
                        <a class="collapse-item" href="{{ route('admin.drinks.index') }}">Danh Sách Đồ Uống</a>
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
                        <a class="collapse-item" href="{{ route('vourcher-events.index') }}">List Vourchers Event</a>


                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers"
                    aria-expanded="true" aria-controls="collapseUsers">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Quản lý người dùng</span>
                </a>
                <div id="collapseUsers" class="collapse" aria-labelledby="headingOrders"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">List function</h6>
                        <a class="collapse-item" href="{{ route('users.index') }}">Danh sách users</a>


                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse"
                    data-target="#collapseStatistics" aria-expanded="true" aria-controls="collapseStatistics">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Thống kê</span>
                </a>
                <div id="collapseStatistics" class="collapse" aria-labelledby="headingStatistics"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">List function</h6>
                        <a class="collapse-item" href="{{ route('admin.statistics.statisticFilmHub') }}">Thống kê hệ
                            thống</a>
                        <a class="collapse-item" href="{{ route('admin.statistics.statisticFilm') }}">Thống kê
                            phim</a>
                    </div>
                </div>
            </li>

            {{-- category --}}
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-ct"
                    aria-expanded="true" aria-controls="collapse-ct">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Danh mục bài viết</span>
                </a>
                <div id="collapse-ct" class="collapse {{request()->routeIs('admin.category.*') ? 'show' : ''}}" aria-labelledby="heading1" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.category.index') }}">Danh sách</a>
                        <a class="collapse-item" href="{{ route('admin.category.create') }}">Tạo mới</a>
                    </div>
                </div>
            </li>
            {{-- Post --}}
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-post"
                    aria-expanded="true" aria-controls="collapse-post">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Tin tức</span>
                </a>
                <div id="collapse-post" class="collapse {{request()->routeIs('admin.post.*') ? 'show' : ''}}" aria-labelledby="heading1" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.post.index') }}">Danh sách</a>
                        <a class="collapse-item" href="{{ route('admin.post.create') }}">Tạo mới</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#banner"
                    aria-expanded="true" aria-controls="collapseMovies">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Quản lý banner</span>
                </a>
                <div id="banner" class="collapse" aria-labelledby="headingMovies"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Danh sách banner</h6>
                        <a class="collapse-item" href="{{ route('banner.index') }}">Danh sách</a>
                    </div>
                </div>
            </li>


        {{-- SIDEBAR MANAGER --}}
        @elseif(Auth::user()->status == 'manager')
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRoom"
                aria-expanded="true" aria-controls="collapseRoom">
                <i class="fas fa-fw fa-cog"></i>
                <span>Quản lý phòng</span>
            </a>
            <div id="collapseRoom" class="collapse" aria-labelledby="headingRoom" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('admin.rooms.index') }}">Danh sách phòng</a>
                    <a class="collapse-item" href="{{ route('admin.rooms.create') }}">Tạo mới</a>
                </div>
            </div>
        </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Quản lý ghế</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.seats.index') }}">Danh sách ghế</a>
                        <a class="collapse-item" href="{{ route('admin.seats.create') }}">Tạo mới</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Quản lý hàng ghế</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Danh sách chức năng</h6>
                        <a class="collapse-item" href="{{ route('admin.rows.index') }}">Danh sách hàng ghế</a>
                        <a class="collapse-item" href="{{ route('admin.rows.create') }}">Tạo mới</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrders"
                    aria-expanded="true" aria-controls="collapseOrders">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Quản lý loại ghế</span>
                </a>
                <div id="collapseOrders" class="collapse" aria-labelledby="headingOrders"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Danh sách chức năng</h6>
                        <a class="collapse-item" href="{{ route('admin.types.index') }}">Danh sách loại ghế</a>
                        <a class="collapse-item" href="{{ route('admin.types.create') }}">Tạo mới</a>

                    </div>
                </div>
            </li>

            {{-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseShifts"
                    aria-expanded="true" aria-controls="collapseShifts">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Quản lý ca chiếu</span>
                </a>
                <div id="collapseShifts" class="collapse" aria-labelledby="headingShifts"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                        <a class="collapse-item" href="{{ route('admin.shifts.index') }}">Danh sách ca chiếu</a>

                        <a class="collapse-item" href="{{ route('admin.shifts.create') }}">Tạo mới</a>

                    </div>
                </div>
            </li> --}}


            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseShowtimes"
                    aria-expanded="true" aria-controls="collapseShowtimes">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Quản lý lịch chiếu</span>
                </a>
                <div id="collapseShowtimes" class="collapse" aria-labelledby="headingOrders"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">List function</h6>
                        <a class="collapse-item" href="{{ route('showtimes.index') }}">Quản lý lịch chiếu </a>
                        {{-- <a class="collapse-item" href="{{ route('bookings.index') }}">Test đặt vé</a> --}}


                    </div>
                </div>
            </li>




            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse"
                    data-target="#collapseStatistics" aria-expanded="true" aria-controls="collapseStatistics">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Thống kê</span>
                </a>
                <div id="collapseStatistics" class="collapse" aria-labelledby="headingStatistics"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">List function</h6>
                        <a class="collapse-item" href="{{ route('admin.statistics.statisticFilmHub') }}">Thống kê hệ
                            thống</a>
                    </div>
                </div>
            </li>





            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTicket"
                    aria-expanded="true" aria-controls="collapseTicket">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Manager Tickets</span>
                </a>
                <div id="collapseTicket" class="collapse" aria-labelledby="headingMovies"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">List Function</h6>
                        <a class="collapse-item" href="{{ route('admin.tickets.index') }}">List Tickets</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseComment"
                    aria-expanded="true" aria-controls="collapseComment">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Manager Comments</span>
                </a>
                <div id="collapseComment" class="collapse" aria-labelledby="headingMovies"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">List Function</h6>
                        <a class="collapse-item" href="{{ route('admin.comments.index') }}">List Comment</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            {{-- <li class="nav-item">
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
    </li> --}}

            {{--    <!-- Divider --> --}}
            {{--    <hr class="sidebar-divider"> --}}

            {{--    <!-- Heading --> --}}
            {{--    <div class="sidebar-heading"> --}}
            {{--        Addons --}}
            {{--    </div> --}}

            {{--    <!-- Nav Item - Pages Collapse Menu --> --}}
            {{--    <li class="nav-item"> --}}
            {{--        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" --}}
            {{--           aria-expanded="true" aria-controls="collapsePages"> --}}
            {{--            <i class="fas fa-fw fa-folder"></i> --}}
            {{--            <span>Pages</span> --}}
            {{--        </a> --}}
            {{--        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar"> --}}
            {{--            <div class="bg-white py-2 collapse-inner rounded"> --}}
            {{--                <h6 class="collapse-header">Login Screens:</h6> --}}
            {{--                <a class="collapse-item" href="login.html">Login</a> --}}
            {{--                <a class="collapse-item" href="register.html">Register</a> --}}
            {{--                <a class="collapse-item" href="forgot-password.html">Forgot Password</a> --}}
            {{--                <div class="collapse-divider"></div> --}}
            {{--                <h6 class="collapse-header">Other Pages:</h6> --}}
            {{--                <a class="collapse-item" href="404.html">404 Page</a> --}}
            {{--                <a class="collapse-item" href="blank.html">Blank Page</a> --}}
            {{--            </div> --}}
            {{--        </div> --}}
            {{--    </li> --}}

            {{--    <!-- Nav Item - Charts --> --}}
            {{--    <li class="nav-item"> --}}
            {{--        <a class="nav-link" href="charts.html"> --}}
            {{--            <i class="fas fa-fw fa-chart-area"></i> --}}
            {{--            <span>Charts</span></a> --}}
            {{--    </li> --}}

            {{--    <!-- Nav Item - Tables --> --}}
            {{--    <li class="nav-item"> --}}
            {{--        <a class="nav-link" href="tables.html"> --}}
            {{--            <i class="fas fa-fw fa-table"></i> --}}
            {{--            <span>Tables</span></a> --}}
            {{--    </li> --}}

            {{--    <!-- Divider --> --}}
            {{--    <hr class="sidebar-divider d-none d-md-block"> --}}

            {{--    <!-- Sidebar Toggler (Sidebar) --> --}}
            {{--    <div class="text-center d-none d-md-inline"> --}}
            {{--        <button class="rounded-circle border-0" id="sidebarToggle"></button> --}}
            {{--    </div> --}}

            {{--    <!-- Sidebar Message --> --}}
            {{--    <div class="sidebar-card d-none d-lg-flex"> --}}
            {{--        <img class="sidebar-card-illustration mb-2" src="{{asset('theme/admin/img/undraw_rocket.svg')}}" alt="..."> --}}
            {{--        <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more! --}}
            {{--        </p> --}}
            {{--        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a> --}}
            {{--    </div> --}}
        @endif
    </ul>
@endif
