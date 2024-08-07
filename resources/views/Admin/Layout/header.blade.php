@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endpush
<nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
    <div class="container-fluid">
        <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
            <div class="input-group">
                <a href="{{ route('home') }}" class="btn btn-sm btn-info">Home Page</a>
            </div>
        </nav>

        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
            <li class="nav-item topbar-icon dropdown hidden-caret">
                <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-bell"></i>
                    <span class="notification">{{ Auth::guard('admin')->user()->unreadNotifications->count() }}</span>
                </a>
                <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                    <li>
                        <div class="dropdown-title">
                            You have {{ Auth::guard('admin')->user()->unreadNotifications->count() }} new
                            notification(s)
                        </div>
                    </li>
                    <li>
                        <div class="notif-scroll scrollbar-outer">
                            <div class="notif-center">
                                @foreach (Auth::guard('admin')->user()->unreadNotifications as $notification)
                                    @if ($notification->type === 'App\Notifications\UserNotification')
                                        <a href="{{ route('data.user') }}">
                                            <div class="pt-1 m-2">
                                                <i class="fa fa-circle" aria-hidden="true"></i>
                                            </div>
                                            <div class="notif-content">
                                                <span class="block">
                                                    {{ $notification->data['nama_lengkap'] }} Melakukan Pendaftaran
                                                </span>
                                                <span class="time">
                                                    {{ $notification->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                        </a>
                                        <div class="d-flex mx-4">
                                            <a href="{{ route('markasread.admin', $notification->id) }}"
                                                class="btn btn-sm btn-secondary">Mark
                                                as Read</a>
                                        </div>
                                    @elseif ($notification->type === 'App\Notifications\BookingNotification')
                                        <a href="{{ route('data.booking') }}">
                                            <div class="pt-1 m-2">
                                                <i class="fa fa-circle" aria-hidden="true"></i>
                                            </div>
                                            <div class="notif-content">
                                                <span class="block">
                                                    {{ $notification->data['nama_user'] }} Melakukan Booking Ruangan
                                                </span>
                                                <span class="time">
                                                    {{ $notification->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                        </a>
                                        <div class="d-flex mx-4">
                                            <a href="{{ route('markasread.admin', $notification->id) }}"
                                                class="btn btn-sm btn-secondary">Mark
                                                as Read</a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>


        <li class="nav-item topbar-user dropdown hidden-caret">
            <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                <div class="avatar-sm">
                    <img src="{{ asset('Admin/assets/img/profile.jpg') }}" alt="..."
                        class="avatar-img rounded-circle" />
                </div>
                <span class="profile-username">
                    <span class="op-7">Hi,</span>
                    <span class="fw-bold">{{ Auth::guard('admin')->user()->username }}</span>
                </span>
            </a>
            <ul class="dropdown-menu dropdown-user animated fadeIn">
                <div class="dropdown-user-scroll scrollbar-outer">
                    <li>
                        <div class="user-box">
                            <div class="avatar-lg">
                                <img src="assets/img/profile.jpg" alt="image profile" class="avatar-img rounded" />
                            </div>
                            <div class="u-text">
                                <h4>{{ Auth::guard('admin')->user()->username }}</h4>
                                <p class="text-muted">admin@gmail.com</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('admin/profile') }}">Profile</a>
                        <a class="dropdown-item" href=""
                            onclick="event.preventDefault(); confirmLogout();">Logout</a>
                    </li>
                </div>
            </ul>
        </li>
        </ul>
    </div>
</nav>
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        function confirmLogout() {
            if (confirm('Yakin Ingin Keluar?')) {
                window.location.href = "{{ route('logout.admin') }}";
            }
        }
    </script>
@endpush
