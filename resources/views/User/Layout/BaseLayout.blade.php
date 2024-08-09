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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">


    <style>
        .footer-area {
            padding: 30px 0;
        }

        .footer_title {
            font-size: 20px;
            margin-bottom: 20px;
            color: #FFFFFF;
        }

        .single-footer-widget p {
            color: #f2f2f2;
        }

        .footer-social a {
            margin-right: 15px;
            font-size: 18px;
            transition: color 0.3s;
        }

        .footer-social a:hover {
            color: #BA68C8;
        }

        .footer-bottom {
            margin-top: 20px;
            padding-top: 20px;
        }

        .footer-text {
            color: #f2f2f2;
            text-align: center;
        }
    </style>
    @stack('css')
</head>

<body>

    <!--================Header Area =================-->
    @include('User.Layout.Header')
    <!--================Header Area =================-->

    @yield('content')


    <!--================ start footer Area  =================-->
    <footer class="footer-area section_gap" style="background-color: #2C3E50; color: #FFFFFF;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 col-sm-6 d-flex justify-content-center">
                    <div class="single-footer-widget">
                        <h6 class="footer_title">Zaitun Homestay</h6>
                        <p>Temukan ketenangan dan kenyamanan maksimal di <b>Zaitun Homestay</b>. Manjakan diri Anda
                            dengan fasilitas terbaik dan layanan ramah yang akan membuat Anda merasa seperti di rumah
                            sendiri.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 d-flex justify-content-center">
                    <div class="single-footer-widget">
                        <h6 class="footer_title">Contact Us</h6>
                        <p><i class="lnr lnr-phone-handset"></i> &nbsp;Telepon: 081376741055</p>
                        <p><i class="lnr lnr-envelope"></i> &nbsp;Email: zaitunhomestay100@gmail.com</p>
                        <p><i class="lnr lnr-location"></i> &nbsp;Alamat: Siantar Narumonda</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 d-flex justify-content-center">
                    <div class="single-footer-widget">
                        <h6 class="footer_title">Follow Us</h6>
                        <div class="footer-social d-flex justify-content-start">
                            <a href="#"><i class="fa fa-facebook" style="color: #FFD700;"></i></a>
                            <a href="https://wa.me/+6281376741055"><i class="fa fa-whatsapp"
                                    style="color: #FFD700;"></i></a>
                            <a
                                href="https://www.instagram.com/homestayzaitunsiantarnarumonda?igsh=Y2xuM3A0azIxZWR2&utm_source=qr "><i
                                    class="fa fa-instagram" style="color: #FFD700;"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row footer-bottom d-flex justify-content-center align-items-center">
                <p class="col-lg-12 col-sm-12 footer-text m-0 text-center">© 2024 Zaitun Homestay. All rights reserved.
                </p>
            </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>


    @stack('js')
</body>

</html>
