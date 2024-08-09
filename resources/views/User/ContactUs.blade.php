@extends('User.Layout.BaseLayout')
@push('css')
    <style>
        .contact-section {
            margin-top: 5%;
            padding: 60px 0;
        }

        #map-container {
            height: 400px;
            width: 100%;
            overflow: hidden;
        }

        iframe {
            width: 100%;
            height: 100%;
            border: 0;
        }

        .social-media a {
            margin-right: 15px;
            font-size: 24px;
            color: #495057;
            text-decoration: none;
        }

        .contact-info,
        .contact-form,
        #map-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .contact-heading {
            text-align: center;
            margin-bottom: 40px;
        }

        .contact-heading h2 {
            font-size: 36px;
            font-weight: bold;
        }
    </style>
@endpush
@section('content')
    <div class="container contact-section">
        <div class="contact-heading">
            <h2>Hubungi Kami</h2>
            <p>Kami Siap Melayani Anda</p>
        </div>
        <div class="row">
            <div class="col-md-4 contact-info">
                <h4>Email</h4>
                <p><i class="fa fa-envelope" aria-hidden="true"></i> zaitunhomestay100@gmail.com</p>
                <h4>No Hp</h4>
                <p><i class="fa fa-phone-square" aria-hidden="true"></i> 081376741055</p>
                <h4>Instagram</h4>
                <p><i class="fa fa-instagram" aria-hidden="true"></i> homestayzaitunsiantarnarumonda</p>
                <h4>Alamat</h4>
                <p><i class="fa fa-map-marker" aria-hidden="true"></i> Siantar Narumonda</p>
            </div>
            <div class="col-md-8" id="map-container">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.2577978757427!2d99.17431157567675!3d2.4207516571967873!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302e001aee7a0d8b%3A0xadf7cd1c001d448e!2sSMA%20Negeri%201%20Narumonda!5e0!3m2!1sid!2sid!4v1723189948708!5m2!1sid!2sid"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
    </div>
@endsection
