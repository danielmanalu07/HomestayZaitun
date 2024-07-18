<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Verification Code Input</title>
    <style>
        .verification-input {
            display: flex;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .verification-input input {
            width: 50px;
            height: 50px;
            text-align: center;
            margin: 0 5px;
            font-size: 2rem;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }

        .lock-image {
            display: flex;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .lock-image img {
            width: 50px;
            height: 50px;
        }

        #loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Enter Verification Code</h5>
                        @if (Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ Session::get('success') }}
                                </button>
                            </div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ Session::get('error') }}
                                </button>
                            </div>
                        @endif
                        <div class="lock-image">
                            <img src="{{ asset('gambar/images/lock.jpg') }}" class="w-100 h-100" alt="Lock Icon">
                        </div>
                        <form id="verification-form" action="{{ route('verify.email') }}" method="POST">
                            @csrf
                            <div class="verification-input">
                                <input type="text" maxlength="1" class="form-control" required>
                                <input type="text" maxlength="1" class="form-control" required>
                                <input type="text" maxlength="1" class="form-control" required>
                                <input type="text" maxlength="1" class="form-control" required>
                                <input type="text" maxlength="1" class="form-control" required>
                                <input type="text" maxlength="1" class="form-control" required>
                            </div>
                            <input type="hidden" name="code" id="code">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-info btn-block">Verify</button>
                            </div>
                    </div>
                    </form>
                    <div class="text-center my-2">
                        <form action="{{ route('resend.code') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-secondary">Kirim Ulang Code</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Screen -->
    <div id="loading-screen" style="display:none;">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <!-- Success Pop-up -->
    <div id="success-popup" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Registrasi Berhasil.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const inputs = document.querySelectorAll('.verification-input input');
            const verificationForm = document.getElementById('verification-form');
            const verificationCodeInput = document.getElementById('code');
            const loadingScreen = document.getElementById('loading-screen');
            const successPopup = new bootstrap.Modal(document.getElementById('success-popup'));

            inputs.forEach((input, index) => {
                input.addEventListener('input', () => {
                    if (input.value.length === 1 && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                });
                input.addEventListener('keydown', (e) => {
                    if (e.key === 'Backspace' && index > 0 && input.value.length === 0) {
                        inputs[index - 1].focus();
                    }
                });
            });

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
        });
    </script>
</body>

</html>
