@extends('User.Layout.BaseLayout')
@push('css')
    <style>
        .banner_area {
            padding-top: 3%;
        }

        #spinner {
            opacity: 0;
            visibility: hidden;
            transition: opacity .5s ease-out, visibility 0s linear .5s;
            z-index: 99999;
        }

        #spinner.show {
            transition: opacity .5s ease-out, visibility 0s linear 0s;
            visibility: visible;
            opacity: 1;
        }

        .room-card {
            margin-bottom: 30px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .room-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .room-card img {
            height: 200px;
            object-fit: cover;
            border-bottom: 1px solid #ddd;
        }

        .room-card h5 {
            margin: 20px 0 10px;
        }

        .room-card .card-body {
            position: relative;
        }

        .room-card .discount {
            position: absolute;
            top: 0;
            left: 0;
            background: #ff5a5f;
            color: white;
            padding: 5px 10px;
            border-bottom-right-radius: 10px;
            font-size: 0.9rem;
        }

        .btn-dark {
            background-color: #343a40;
            border-color: #343a40;
        }

        .btn-dark:hover {
            background-color: #23272b;
            border-color: #23272b;
        }

        .available {
            color: green;
            font-weight: bold;
        }

        .unavailable {
            color: red;
            font-weight: bold;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endpush
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const spinner = document.getElementById('spinner');
            spinner.classList.remove('show');
        });

        window.addEventListener('load', function() {
            const spinner = document.getElementById('spinner');
            spinner.classList.remove('show');
        });

        function showImageModal(imageSrc) {
            const modal = new bootstrap.Modal(document.getElementById('imageModal'));
            document.getElementById('modalImage').src = imageSrc;
            modal.show();
        }

        function showImageModal(roomId) {
            fetch(`/room/${roomId}/images`)
                .then(response => response.json())
                .then(data => {
                    const carouselImages = document.getElementById('carouselImages');
                    carouselImages.innerHTML = '';

                    if (data.gambar_utama) {
                        carouselImages.innerHTML += `
                    <div class="carousel-item active">
                        <img src="${data.gambar_utama}" class="d-block w-100" alt="Gambar Utama">
                    </div>`;
                    }

                    if (data.gambar2) {
                        carouselImages.innerHTML += `
                    <div class="carousel-item">
                        <img src="${data.gambar2}" class="d-block w-100" alt="Gambar 2">
                    </div>`;
                    }

                    if (data.gambar3) {
                        carouselImages.innerHTML += `
                    <div class="carousel-item">
                        <img src="${data.gambar3}" class="d-block w-100" alt="Gambar 3">
                    </div>`;
                    }

                    if (data.gambar4) {
                        carouselImages.innerHTML += `
                    <div class="carousel-item">
                        <img src="${data.gambar4}" class="d-block w-100" alt="Gambar 4">
                    </div>`;
                    }

                    if (!data.gambar2 && !data.gambar3 && !data.gambar4) {
                        carouselImages.innerHTML += `
                    <div class="carousel-item">
                        <img src="${data.gambar_utama}" class="d-block w-100" alt="Gambar Utama">
                    </div>`;
                    }

                    const modal = new bootstrap.Modal(document.getElementById('imageModal'));
                    modal.show();
                });
        }
    </script>
@endpush
@section('content')
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <section class="banner_area my-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="card-header my-5 text-center">
                    <h3>Detail Kamar</h3>
                </div>
                @foreach ($kamars as $room)
                    <div class="col-md-4">
                        <div class="card room-card">
                            @if (isset($diskons[$room->id]) && $diskons[$room->id]->isNotEmpty())
                                @php
                                    $jumlah_diskon = intVal($diskons[$room->id][0]->jumlah_diskon);
                                    $harga_lama = $room->harga_kamar / (1 - $jumlah_diskon / 100);
                                @endphp
                                <div class="discount">
                                    {{ $jumlah_diskon }}% OFF
                                </div>
                            @endif
                            <img class="card-img-top"
                                src="{{ isset($galleries[$room->id][0]->gambar_utama) ? asset('gambar/gallery/gambar_utama/' . $galleries[$room->id][0]->gambar_utama) : asset('path/to/default/image.jpg') }}"
                                alt="Gambar Utama" onclick="showImageModal({{ $room->id }})">
                            <div class="card-body">
                                <p class="card-text">
                                    <strong>Nomor Kamar:</strong> {{ $room->no_kamar }}<br>
                                    @if (isset($diskons[$room->id]) && $diskons[$room->id]->isNotEmpty())
                                        <strong>Harga:</strong>
                                        <span style="text-decoration: line-through;">Rp
                                            {{ number_format($harga_lama) }}</span>
                                        <span class="text-danger">Rp {{ number_format($room->harga_kamar) }}</span><br>
                                    @else
                                        <strong>Harga:</strong> Rp {{ number_format($room->harga_kamar) }}<br>
                                    @endif
                                    <strong>Kapasitas:</strong> {{ $room->kapasitas }} orang<br>
                                    <strong>Status:</strong>
                                    @if ($room->status == 'Tersedia')
                                        <span class="available">Tersedia</span>
                                    @else
                                        <span class="unavailable">Tidak Tersedia</span>
                                    @endif
                                    <br>
                                    <strong>Pengunjung:</strong> {{ $room->view }}
                                </p>
                                <a href="{{ route('booking') }}" class="btn btn-dark">Pesan Sekarang</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <span class="close-btn" data-bs-dismiss="modal">&times;</span>
                <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner" id="carouselImages"></div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
