@extends('User.Layout.BaseLayout')
@push('css')
    <style>
        .carousel-item {
            height: 50vh;
            background-size: cover;
            background-position: center;
        }

        .banner_content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #fff;
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

        .image-container {
            height: 200px;
            overflow: hidden;
        }

        .image-container img {
            height: 100%;
            width: 100%;
            object-fit: cover;
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

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.view-more-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const kategori = JSON.parse(this.getAttribute('data-kategori'));
                    document.getElementById('modalNama').textContent = kategori.nama;
                    document.getElementById('modalDeskripsi').textContent = kategori.deskripsi;
                    document.getElementById('modalGambar').src =
                        `{{ asset('gambar/kategoriKamar') }}/${kategori.gambar}`;
                    const myModal = new bootstrap.Modal(document.getElementById('viewMoreModal'));
                    myModal.show();
                });
            });
        });
    </script>
@endpush
@section('content')
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <section class="banner_area my-5">
        <div id="bannerCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" style="background-image: url('{{ asset('img/carousel-1.jpg') }}');">
                    <div class="container">
                        <div class="banner_content text-center">
                            <h3>ROOMS</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hotel_booking_area position">
            <div class="container">
            </div>
        </div>
    </section>
    <div class="container my-5">
        <div class="row g-4">
            @foreach ($kategoris as $item)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="room-item shadow rounded overflow-hidden">
                        <div class="position-relative image-container">
                            <img class="img-fluid" src="{{ asset('gambar/kategoriKamar/' . $item->gambar) }}"
                                alt="">
                        </div>
                        <div class="p-4 mt-2">
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="mb-0">{{ $item->nama }}</h5>
                                <div class="ps-2">
                                    <small class="fa fa-star" style="color: gold"></small>
                                    <small class="fa fa-star" style="color: gold"></small>
                                    <small class="fa fa-star" style="color: gold"></small>
                                    <small class="fa fa-star" style="color: gold"></small>
                                    <small class="fa fa-star" style="color: gold"></small>
                                </div>
                            </div>
                            <p class="text-body mb-3">{{ Str::limit($item->deskripsi, 40) }}</p>
                            <div class="d-flex justify-content-between">
                                <a class="btn btn-sm btn-info rounded py-2 px-4"
                                    href="{{ route('detail.room', $item->id) }}">Detail Kamar</a>
                                <button class="btn btn-sm btn-info rounded py-2 px-4 view-more-btn"
                                    data-kategori="{{ $item }}">Lihat Selengkapnya</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="viewMoreModal" tabindex="-1" aria-labelledby="viewMoreModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewMoreModalLabel">Detail Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img id="modalGambar" class="img-fluid" src="" alt="">
                        </div>
                        <div class="col-md-6">
                            <h5 id="modalNama"></h5>
                            <p id="modalDeskripsi"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
