@extends('User.Layout.BaseLayout')
@push('css')
    <style>
        .contact-heading h2 {
            font-size: 36px;
            font-weight: bold;
        }

        .facilities-section {
            padding: 60px 0;
        }

        .facility {
            margin-bottom: 40px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .facility:hover {
            transform: scale(1.05);
        }

        .facility img {
            width: 100%;
            max-width: 400px;
            height: 300px;
            border-radius: 10px;
            transition: transform 0.3s ease-in-out;
        }

        .facility:hover img {
            transform: scale(1.1);
        }

        .facility-description {
            margin-top: 20px;
            text-align: center;
        }

        .facility h4 {
            font-size: 24px;
            font-weight: bold;
        }

        .facility p {
            font-size: 16px;
            color: #666666;
        }
    </style>
@endpush
@section('content')
    <div class="container facilities-section">
        <div class="contact-heading text-center" style="padding-top: 6%;">
            <h2>Fasilitas</h2>
        </div>
        <div class="row">
            @foreach ($fasilitas as $item)
                <div class="col-md-4">
                    <div class="facility">
                        <img src="{{ asset('gambar/fasilitas/' . $item->gambar) }}" alt="Image">
                        <div class="facility-description">
                            <h4>{{ $item->nama }}</h4>
                            <p>{{ $item->deskripsi }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
