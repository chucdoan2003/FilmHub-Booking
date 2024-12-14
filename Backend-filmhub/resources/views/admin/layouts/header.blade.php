<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->





    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                 aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small"
                               placeholder="Search for..." aria-label="Search"
                               aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>



        <!-- Nav Item - Messages -->
        <li class="nav-item dropdown no-arrow mx-1 " style="margin-top: 15px;">
            @if (Auth::check())
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <li>
                    <button class="btn btn-danger text-white" type="submit" data-text="Logout">
                        <span>Log out</span>
                    </button>
                </li>
            </form>
        @else
            <li><a href="{{ route('getLogin') }}" class="btn btn-danger text-white"
                    data-text="Sign in"><span>Sign in</span></a>
            </li>
        @endif

        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if(Auth::check())
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->status }}</span>
                    <!-- Kiểm tra xem người dùng có ảnh đại diện không, nếu có thì hiển thị -->
                    <img class="img-profile rounded-circle"
                         src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('theme/admin/img/undraw_profile.svg') }}">
                @else
                    <!-- Nếu chưa đăng nhập, hiển thị tên mặc định hoặc gì đó -->
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Guest</span>
                    <img class="img-profile rounded-circle" src="{{ asset('theme/admin/img/undraw_profile.svg') }}">
                @endif
            </a>
            <!-- Dropdown - User Information -->
        </li>

    </ul>

</nav>
