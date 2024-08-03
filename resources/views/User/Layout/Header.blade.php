<header class="header_area" style="background-color: skyblue;">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: skyblue;">
            <a class="navbar-brand logo_h" href="">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" width="150px" height="100px">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse offset text-dark" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('room') }}">Room</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('fasilitas') }}">Fasilitas</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contactus') }}">Contact Us</a></li>

                    @auth('admin')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user"></i> {{ Auth::guard('admin')->user()->username }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('dashboard.admin') }}">Dashboard</a>
                                <a class="dropdown-item" href="{{ route('logout.admin') }}"
                                    onclick="return confirmLogout(event)">Logout</a>
                            </div>
                        </li>
                        @elseauth('user')
                        <li class="nav-item"><a class="nav-link" href="{{ route('mybooking') }}">My Booking</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user"></i> {{ Auth::guard('user')->user()->nama_lengkap }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a>
                                <a class="dropdown-item" href="{{ route('logout.user') }}"
                                    onclick="return confirmLogout(event)">Logout</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown">
                                <a class="dropdown-item" href="#">Notifikasi 1</a>
                                <a class="dropdown-item" href="#">Notifikasi 2</a>
                                <a class="dropdown-item" href="#">Notifikasi 3</a>
                            </div>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('login.user') }}">Login</a>
                                <a class="dropdown-item" href="{{ route('register.user') }}">Register</a>
                            </div>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>
    </div>
</header>
