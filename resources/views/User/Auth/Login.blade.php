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

        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="{{ asset('Customer/Auth/images/signin-image.jpg') }}" alt="sing up image">
                        </figure>
                        <a href="{{ route('register.user') }}" class="signup-image-link">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Sign in</h2>
                        @if (Session::has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ Session::get('error') }}
                                </button>
                            </div>
                        @endif
                        @if (Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ Session::get('success') }}
                                </button>
                            </div>
                        @endif
                        <form action="{{ route('login.user') }}" method="POST" class="register-form" id="login-form">
                            @csrf
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Enter Your Email" />
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
                            <span><a style="color: black; text-decoration:none;"
                                    href="{{ route('user.lupapassword') }}">Lupa
                                    Password?</a></span>
                            <div class="form-group form-button">
                                <button type="submit" name="signin" id="signin" class="form-submit">Log in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div id="loading-screen" style="display:none;">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <!-- JS -->
    <script src="{{ asset('Customer/Auth/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('Customer/Auth/js/main.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script> --}}
    <script>
        verificationForm.addEventListener('submit', (e) => {
            e.preventDefault();
            loadingScreen.style.display = 'flex';
            let code = '';
            inputs.forEach(input => {
                code += input.value;
            });
            verificationCodeInput.value = code;

            setTimeout(() => {
                loadingScreen.style.display = 'none';
                successPopup.show();
                verificationForm
                    .submit();
            }, 2000);
        });
    </script>
</body>

</html>
