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
                        <div class="lock-image">
                            <img src="{{ asset('gambar/images/lock.jpg') }}" class="w-100 h-100" alt="Lock Icon">
                        </div>
                        <form id="verification-form" action="{{ route('code.resetpassword') }}" method="POST">
                            @csrf
                            <div class="verification-input">
                                <input type="text" maxlength="1" class="form-control" required>
                                <input type="text" maxlength="1" class="form-control" required>
                                <input type="text" maxlength="1" class="form-control" required>
                                <input type="text" maxlength="1" class="form-control" required>
                                <input type="text" maxlength="1" class="form-control" required>
                                <input type="text" maxlength="1" class="form-control" required>
                            </div>
                            <input type="hidden" name="verification_code" id="verification_code">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-info btn-block">Verify</button>
                            </div>
                        </form>
                        <div class="text-center my-2">
                            <form action="{{ route('resend.codeResetPassword') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-secondary">Resend Code</button>
                            </form>
                        </div>
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

    <!-- Modal for Success/Error Messages -->
    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel">Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="messageText"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
            const verificationCodeInput = document.getElementById('verification_code');
            const loadingScreen = document.getElementById('loading-screen');

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
                    verificationForm.submit();
                }, 2000);
            });

            @if (Session::has('success') || Session::has('error'))
                $(document).ready(function() {
                    const messageText = '{{ Session::get('success') ?? Session::get('error') }}';
                    $('#messageText').text(messageText);
                    $('#messageModal').modal('show');
                });
            @endif
        });
    </script>
</body>

</html>
