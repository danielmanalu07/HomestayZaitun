<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Code Verification</title>
</head>

<body>
    <h1>Halo {{ $user->nama_lengkap }}</h1>
    <p>Anda Telah Melakukan Reset Password Terhadap Akun Anda. Tolong Jangan Diberikan Code Berikut Kepada Pihak Lain
    </p> <br>
    <p>Agar Tidak Ada Terjadi Hal yang sensitif Terhadap Akun Anda</p>
    <p><strong>Kode Verifikasi Reset Password: {{ $code }}</strong></p>
</body>

</html>
