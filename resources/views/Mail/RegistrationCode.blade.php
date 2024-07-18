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
    <h1>Terimakasih Telah Melakukan Pendaftaran</h1>
    <h4>Selamat Datang {{ $user->nama_lengkap }}</h4>
    <p><strong>Your Code Email Verification: {{ $code }}</strong></p>
</body>

</html>
