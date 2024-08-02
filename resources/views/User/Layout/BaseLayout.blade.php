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


    @stack('css')
</head>

<body>

    <!--================Header Area =================-->
    @include('User.Layout.Header')
    <!--================Header Area =================-->

    @yield('content')


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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>


    @stack('js')
</body>

</html>
