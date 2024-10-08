<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{ asset('Guest/image/favicon.png') }}" type="image/png">
    <title>Zaitun Homestay</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('Guest/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('Guest/vendors/linericon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('Guest/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Guest/vendors/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Guest/vendors/bootstrap-datepicker/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Guest/vendors/nice-select/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('Guest/vendors/owl-carousel/owl.carousel.min.css') }}">
    <!-- main css -->
    <link rel="stylesheet" href="{{ asset('Guest/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('Guest/css/responsive.css') }}">
    <style>
        .carousel-item {
            height: 100vh;
            background-size: cover;
            background-position: center;
        }

        .banner_content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #fff;
        }
    </style>
</head>

<body>

    <!--================Header Area =================-->
    <header class="header_area">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand logo_h" href="index.html"><img src="{{ asset('Guest/image/Logo.png') }}"
                        alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">
                        <li class="nav-item active"><a class="nav-link" href="index.html">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="Room.html">Room</a></li>
                        <li class="nav-item"><a class="nav-link" href="gallery.html">Gallery</a></li>
                        <li class="nav-item"><a class="nav-link" href="History.html">History</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                        <!-- User Icon -->
                        <li class="nav-item dropdown">
                            @auth('user')
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user"></i> {{ Auth::guard('user')->user()->nama_lengkap }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="">Profile</a>
                                    <a class="dropdown-item" onclick="return confirmLogout(event)"
                                        href="{{ route('logout.user') }}">Logout</a>
                                </div>
                            @else
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{ route('login.user') }}">Login</a>
                                    <a class="dropdown-item" href="{{ route('register.user') }}">Register</a>
                                </div>
                            @endauth
                        </li>
                        <!-- Notification Icon -->
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
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <!--================Header Area =================-->

    <!--================Banner Area =================-->
    <section class="banner_area">
        <div id="bannerCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#bannerCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#bannerCarousel" data-slide-to="1"></li>
                <li data-target="#bannerCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active"
                    style="background-image: url('{{ asset('Guest/image/about_banner.jpg') }}');">
                    <div class="container">
                        <div class="banner_content text-center">
                            <h6>Away from monotonous life</h6>
                            <h2>Relax Your Mind</h2>
                            <p>If you are looking at blank cassettes on the web, you may be very confused at the<br>
                                difference in price. You may see some for as low as $.17 each.</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item"
                    style="background-image: url('{{ asset('Guest/image/banner_bg.jpg') }}');">
                    <div class="container">
                        <div class="banner_content text-center">
                            <h6>Discover New Horizons</h6>
                            <h2>Adventure Awaits</h2>
                            <p>Explore the unexplored, and embark on a journey of a lifetime. Your adventure begins
                                here.</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item"
                    style="background-image: url('{{ asset('Guest/image/facilites_bg.jpg') }}');">
                    <div class="container">
                        <div class="banner_content text-center">
                            <h6>Experience Luxury</h6>
                            <h2>Stay with Us</h2>
                            <p>Indulge in the ultimate luxury experience with our top-notch amenities and exceptional
                                service.</p>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#bannerCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#bannerCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="hotel_booking_area position">
            <div class="container">
            </div>
        </div>
    </section>
    <!--================Banner Area =================-->

    <!--================ Accomodation Area  =================-->
    <section class="accomodation_area section_gap">
        <div class="container">
            <div class="section_title text-center">
                <h2 class="title_color">Recomendation Room</h2>
            </div>
            <div class="row mb_30">
                <div class="col-lg-3 col-sm-6">
                    <div class="accomodation_item text-center">
                        <div class="hotel_img">
                            <img src="{{ asset('Guest/image/room1.jpg') }}" alt="">
                            <a href="ViewDetails.html" class="btn theme_btn button_hover">Lihat Detail</a>
                        </div>
                        <a href="ViewDetails.html">
                            <h4 class="sec_h4">Double Deluxe Room</h4>
                        </a>
                        <h5>$250<small>/night</small></h5>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="accomodation_item text-center">
                        <div class="hotel_img">
                            <img src="{{ asset('Guest/image/room2.jpg') }}" alt="">
                            <a href="ViewDetails.html" class="btn theme_btn button_hover">Lihat Detail</a>
                        </div>
                        <a href="ViewDetails.html">
                            <h4 class="sec_h4">Single Deluxe Room</h4>
                        </a>
                        <h5>$200<small>/night</small></h5>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="accomodation_item text-center">
                        <div class="hotel_img">
                            <img src="{{ asset('Guest/image/room3.jpg') }}" alt="">
                            <a href="ViewDetails.html" class="btn theme_btn button_hover">Lihat Detail</a>
                        </div>
                        <a href="ViewDetails.html">
                            <h4 class="sec_h4">Honeymoon Suit</h4>
                        </a>
                        <h5>$750<small>/night</small></h5>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="accomodation_item text-center">
                        <div class="hotel_img">
                            <img src="{{ asset('Guest/image/room4.jpg') }}" alt="">
                            <a href="ViewDetails.html" class="btn theme_btn button_hover">Lihat Detail</a>
                        </div>
                        <a href="ViewDetails.html">
                            <h4 class="sec_h4">Economy Double</h4>
                        </a>
                        <h5>$200<small>/night</small></h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ Accomodation Area  =================-->

    <!--================ Facilities Area  =================-->
    <section class="facilities_area section_gap">
        <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0"
            data-background="">
        </div>
        <div class="container">
            <div class="section_title text-center">
                <h2 class="title_w">Fasilitas</h2>
            </div>
            <div class="row mb_30">
                <div class="col-lg-4 col-md-6">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-dinner"></i>Restaurant</h4>
                        <p>Usage of the Internet is becoming more common due to rapid advancement of technology and
                            power.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-bicycle"></i>Sports CLub</h4>
                        <p>Usage of the Internet is becoming more common due to rapid advancement of technology and
                            power.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-shirt"></i>Swimming Pool</h4>
                        <p>Usage of the Internet is becoming more common due to rapid advancement of technology and
                            power.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-car"></i>Rent a Car</h4>
                        <p>Usage of the Internet is becoming more common due to rapid advancement of technology and
                            power.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-construction"></i>Gymnesium</h4>
                        <p>Usage of the Internet is becoming more common due to rapid advancement of technology and
                            power.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-coffee-cup"></i>Bar</h4>
                        <p>Usage of the Internet is becoming more common due to rapid advancement of technology and
                            power.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ Facilities Area  =================-->

    <!--================ About History Area  =================-->
    <section class="about_history_area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d_flex align-items-center">
                    <div class="about_content ">
                        <h2 class="title title_color">About Us <br>Our History<br>Mission & Vision</h2>
                        <p>inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct
                            standards especially in the workplace. That’s why it’s crucial that, as women, our behavior
                            on the job is beyond reproach. inappropriate behavior is often laughed.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <img class="img-fluid" src="{{ asset('Guest/image/about_bg.jpg') }}" alt="img">
                </div>
            </div>
        </div>
    </section>
    <!--================ About History Area  =================-->



    <!--================ Latest Blog Area  =================-->
    <section class="latest_blog_area section_gap">
        <div class="container">
            <div class="section_title text-center">
                <h2 class="title_color">latest posts from blog</h2>
                <p>The French Revolution constituted for the conscience of the dominant aristocratic class a fall from
                </p>
            </div>
            <div class="row mb_30">
                <div class="col-lg-4 col-md-6">
                    <div class="single-recent-blog-post">
                        <div class="thumb">
                            <img class="img-fluid" src="{{ asset('Guest/image/blog/blog-1.jpg') }}" alt="post">
                        </div>
                        <div class="details">
                            <div class="tags">
                                <a href="#" class="button_hover tag_btn">Travel</a>
                                <a href="#" class="button_hover tag_btn">Life Style</a>
                            </div>
                            <a href="#">
                                <h4 class="sec_h4">Low Cost Advertising</h4>
                            </a>
                            <p>Acres of Diamonds… you’ve read the famous story, or at least had it related to you. A
                                farmer.</p>
                            <h6 class="date title_color">31st January,2018</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-recent-blog-post">
                        <div class="thumb">
                            <img class="img-fluid" src="{{ asset('Guest/image/blog/blog-2.jpg') }}" alt="post">
                        </div>
                        <div class="details">
                            <div class="tags">
                                <a href="#" class="button_hover tag_btn">Travel</a>
                                <a href="#" class="button_hover tag_btn">Life Style</a>
                            </div>
                            <a href="#">
                                <h4 class="sec_h4">Creative Outdoor Ads</h4>
                            </a>
                            <p>Self-doubt and fear interfere with our ability to achieve or set goals. Self-doubt and
                                fear are</p>
                            <h6 class="date title_color">31st January,2018</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-recent-blog-post">
                        <div class="thumb">
                            <img class="img-fluid" src="{{ asset('Guest/image/blog/blog-3.jpg') }}" alt="post">
                        </div>
                        <div class="details">
                            <div class="tags">
                                <a href="#" class="button_hover tag_btn">Travel</a>
                                <a href="#" class="button_hover tag_btn">Life Style</a>
                            </div>
                            <a href="#">
                                <h4 class="sec_h4">It S Classified How To Utilize Free</h4>
                            </a>
                            <p>Why do you want to motivate yourself? Actually, just answering that question fully can
                            </p>
                            <h6 class="date title_color">31st January,2018</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ Recent Area  =================-->

    <!--================ start footer Area  =================-->
    <footer class="footer-area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-3  col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6 class="footer_title">Zaitun Homestay</h6>
                        <p>Temukan ketenangan dan kenyamanan maksimal di <b>Zaitun Homestay</b>.
                            Manjakan diri Anda dengan fasilitas terbaik dan layanan ramah yang akan membuat Anda merasa
                            seperti di rumah sendiri. </p>
                    </div>
                </div>
                <div class="col-lg-3  col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6 class="footer_title">About As</h6>
                        <p><i class="lnr lnr-phone-handset"></i> &nbsp;Telepon &nbsp;:</p>
                        <p><i class="lnr lnr-envelope"></i> &nbsp;Email &nbsp; &nbsp; &nbsp; :</p>
                        <p><i class="lnr lnr-location">&nbsp;</i>Alamat &nbsp;&nbsp; :</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6 class="footer_title">Social Media</h6>
                        <div class="row footer-bottom d-flex justify-content-between align-items-center">
                            <div class="col-lg-4 col-sm-12 footer-social d-flex justify-content-start">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-whatsapp"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border_line"></div>
        </div>
    </footer>
    <!--================ End footer Area  =================-->


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('Guest/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('Guest/js/popper.js') }}"></script>
    <script src="{{ asset('Guest/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendors/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('Guest/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('Guest/js/mail-script.js') }}"></script>
    <script src="{{ asset('Guest/vendors/bootstrap-datepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('Guest/vendors/nice-select/js/jquery.nice-select.js') }}"></script>
    <script src="{{ asset('Guest/js/mail-script.js') }}"></script>
    <script src="{{ asset('Guest/js/stellar.js') }}"></script>
    <script src="{{ asset('Guest/vendors/lightbox/simpleLightbox.min.js') }}"></script>
    <script src="{{ asset('Guest/js/custom.js') }}"></script>
    <script>
        function confirmLogout(event) {
            event.preventDefault();
            if (confirm('Are you sure you want to log out?')) {
                window.location.href = event.target.href;
            }
        }
    </script>
</body>

</html>
