<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="" class="logo mt-2">
                <img src="{{ asset('img/logo.png') }}" alt="navbar brand" class="navbar-brand" height="80"
                    width="150" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item">
                    <a href="{{ route('dashboard.admin') }}" class="collapsed" aria-expanded="true">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>

                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>Kategori Kamar</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ url('/admin/kategori-kamar/create') }}">
                                    <span class="sub-item">Tambah Data Kategori Kamar</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/admin/kategori-kamar') }}">
                                    <span class="sub-item">Lihat Data Kategori Kamar</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarLayouts">
                        <i class="fas fa-th-list"></i>
                        <p>Fasilitas</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarLayouts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ url('/admin/fasilitas/create') }}">
                                    <span class="sub-item">Tambah Data Fasilitas</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/admin/fasilitas') }}">
                                    <span class="sub-item">Lihat Data Fasilitas</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#forms">
                        <i class="fas fa-pen-square"></i>
                        <p>Carousel</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="forms">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ url('/admin/carousel/create') }}">
                                    <span class="sub-item">Tambah Data Carousel</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/admin/carousel') }}">
                                    <span class="sub-item">Lihat Data Carousel</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#tables">
                        <i class="fas fa-table"></i>
                        <p>Kamar</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="tables">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ url('/admin/kamar/create') }}">
                                    <span class="sub-item">Tambah Data Kamar</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/admin/kamar') }}">
                                    <span class="sub-item">Lihat Data Kamar</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#gallery">
                        <i class="fas fa-image" aria-hidden="true"></i>
                        <p>Gallery Kamar</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="gallery">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ url('/admin/gallery/create') }}">
                                    <span class="sub-item">Tambah Data Gallery</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/admin/gallery') }}">
                                    <span class="sub-item">Lihat Data Gallery</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#content1">
                        <i class="fas fa-desktop"></i>
                        <p>Konten</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="content1">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ url('/admin/konten1/create') }}">
                                    <span class="sub-item">Tambah Data Konten</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/admin/konten1') }}">
                                    <span class="sub-item">Lihat Data Konten</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#diskon">
                        <i class="far fa-credit-card" aria-hidden="true"></i>
                        <p>Diskon</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="diskon">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ url('/admin/diskon/create') }}">
                                    <span class="sub-item">Tambah Data Diskon</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/admin/diskon') }}">
                                    <span class="sub-item">Lihat Data Diskon</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#customer">
                        <i class="fas fa-user" aria-hidden="true"></i>
                        <p>Akun Customer</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="customer">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('data.user') }}">
                                    <span class="sub-item">Lihat Data Akun Customer</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#bookings">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        <p>User Bookings</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="bookings">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('data.booking') }}">
                                    <span class="sub-item">Lihat Data Booking</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
