<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form</title>

    <!-- Font Icon -->
    <link rel="stylesheet"
        href="{{ asset('Customer/Auth/fonts/material-icon/css/material-design-iconic-font.min.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('Customer/Auth/css/style.css') }}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}

</head>

<body>

    <div class="main">

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        @if (Session::has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ Session::get('error') }}
                                </button>
                            </div>
                        @endif
                        <form action="{{ route('register.user') }}" method="POST" class="register-form"
                            id="register-form" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="nama_lengkap"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="nama_lengkap" id="nama_lengkap"
                                    placeholder="Nama Lengkap" />
                                @error('nama_lengkap')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Email" />
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password" />
                                @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    placeholder="Konfirmasi Password" />
                                @error('password_confirmation')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone"><i class="zmdi zmdi-phone"></i></label>
                                <input type="number" name="phone" id="phone" placeholder="Phone" />
                                @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="alamat"><i class="zmdi zmdi-home"></i></label>
                                <input type="text" name="alamat" id="alamat" placeholder="Alamat">
                                @error('alamat')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="photo"><i class="zmdi zmdi-camera"></i></label>
                                <input type="file" name="photo" id="photo" />
                                @error('photo')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <img id="preview-image" src="" alt="Preview Image"
                                    style="max-height: 200px; display: none;">
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all
                                    statements in <a href="#" class="term-service">Terms of service</a></label>
                                <div class="alert alert-danger text-danger" id="agree-term-error"
                                    style="display: none;">You must
                                    agree to the terms</div>
                            </div>
                            <div class="form-group form-button">
                                <button type="submit" name="signup" id="signup"
                                    class="form-submit">Register</button>
                            </div>
                        </form>
                    </div>
                    <a href="{{ route('home') }}">
                        <div class="signup-image">
                            <figure style="background-color: purple; border-radius:5%;"><img
                                    src="{{ asset('img/logo.png') }}" alt="sing up image">
                            </figure>
                            <a href="{{ route('login.user') }}" class="signup-image-link">I am already have an
                                account</a>
                        </div>
                    </a>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="{{ asset('Customer/Auth/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('Customer/Auth/js/main.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script> --}}
    <script>
        document.getElementById('photo').addEventListener('change', function(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview-image');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        });

        document.getElementById('register-form').addEventListener('submit', function(event) {
            var agreeTerm = document.getElementById('agree-term');
            var agreeTermError = document.getElementById('agree-term-error');

            if (!agreeTerm.checked) {
                event.preventDefault();
                agreeTermError.style.display = 'block';
            } else {
                agreeTermError.style.display = 'none';
            }
        });
    </script>
</body>

</html>
