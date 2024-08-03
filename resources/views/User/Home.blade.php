@extends('User.Layout.BaseLayout')
@push('css')
    <style>
        .carousel-item {
            height: 100vh;
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
    </style>
@endpush
@push('js')
    <script>
        function confirmLogout(event) {
            event.preventDefault();
            if (confirm('Are you sure you want to log out?')) {
                window.location.href = event.target.href;
            }
        }
    </script>
@endpush
@section('content')
    <!--================Banner Area =================-->
    <section class="banner_area">
        <div id="bannerCarousel" class="carousel slide" data-ride="carousel" style="padding-top: 5%;">
            <ol class="carousel-indicators">
                @foreach ($carousel as $index => $item)
                    <li data-target="#bannerCarousel" data-slide-to="{{ $index }}"
                        class="{{ $index == 0 ? 'active' : '' }}"></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach ($carousel as $index => $item)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}"
                        style="background-image: url('{{ asset('gambar/carousel/' . $item->gambar) }}');">
                        <div class="container">
                            <div class="banner_content text-center text-bg-dark">
                                <h2>{{ $item->text }}</h2>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#bannerCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#bannerCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="hotel_booking_area position">
            <div class="container">
            </div>
        </div>
    </section>

    <!--================Banner Area =================-->

    <!--================ Accomodation Area  =================-->
    <section class="accomodation_area section_gap">
        <div class="container">
            <div class="section_title text-center">
                <h2 class="title_color">Recomendation Room</h2>
            </div>
            <div class="row mb_30">
                @foreach ($kategoris as $kategori)
                    <div class="col-lg-3 col-sm-6">
                        <div class="accomodation_item text-center">
                            <div class="hotel_img">
                                <img src="{{ asset('gambar/kategoriKamar/' . $kategori->gambar) }}" alt=""
                                    width="100%" height="200px" style="object-fit: cover;">
                                <a href="{{ route('detail.room', $kategori->id) }}" class="btn theme_btn button_hover">Lihat
                                    Detail</a>
                            </div>
                            <a href="ViewDetails.html">
                                <h4 class="sec_h4">{{ $kategori->nama }}</h4>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!--================ Accomodation Area  =================-->

    <!--================ Facilities Area  =================-->
    <section class="facilities_area section_gap">
        <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background="">
        </div>
        <div class="container">
            <div class="section_title text-center">
                <h2 class="title_w">Fasilitas</h2>
            </div>
            @if (count($fasilitas) > 6)
                <div id="facilitiesCarousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach ($fasilitas->chunk(6) as $index => $chunk)
                            <li data-target="#facilitiesCarousel" data-slide-to="{{ $index }}"
                                class="{{ $index == 0 ? 'active' : '' }}"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach ($fasilitas->chunk(6) as $index => $chunk)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <div class="row">
                                    @foreach ($chunk as $item)
                                        <div class="col-lg-4 col-md-6">
                                            <div class="facilities_item">
                                                <div class="facilities_img mb-2">
                                                    <img src="{{ asset('gambar/fasilitas/' . $item->gambar) }}"
                                                        alt="{{ $item->nama }}"
                                                        class="img-fluid img-thumbnail zoom-image">
                                                </div>
                                                <h4>{{ $item->nama }}</h4>
                                                <p id="deskripsi-{{ $item->id }}">
                                                    {{ Str::limit($item->deskripsi, 30) }}
                                                    @if (Str::length($item->deskripsi) > 30)
                                                        <a href="#" class="view-more" data-toggle="modal"
                                                            data-target="#descriptionModal" data-nama="{{ $item->nama }}"
                                                            data-deskripsi="{{ $item->deskripsi }}">More</a>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <a class="carousel-control-prev custom-carousel-control-prev" href="#facilitiesCarousel" role="button"
                    data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next custom-carousel-control-next" href="#facilitiesCarousel" role="button"
                    data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            @else
                <div class="row mb_30">
                    @foreach ($fasilitas as $item)
                        <div class="col-lg-4 col-md-6">
                            <div class="facilities_item">
                                <div class="facilities_img mb-2">
                                    <img src="{{ asset('gambar/fasilitas/' . $item->gambar) }}" alt="{{ $item->nama }}"
                                        class="img-fluid img-thumbnail zoom-image">
                                </div>
                                <h4>{{ $item->nama }}</h4>
                                <p id="deskripsi-{{ $item->id }}">
                                    {{ Str::limit($item->deskripsi, 30) }}
                                    @if (Str::length($item->deskripsi) > 30)
                                        <a href="#" class="view-more" data-toggle="modal"
                                            data-target="#descriptionModal" data-nama="{{ $item->nama }}"
                                            data-deskripsi="{{ $item->deskripsi }}">More</a>
                                    @endif
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
    <!--================ Facilities Area  =================-->



    <!--================ Latest Blog Area  =================-->
    <section class="latest_blog_area section_gap">
        <div class="container">
            <div class="section_title text-center">
                <h2 class="title_color">Informasi Tambahan</h2>
                <p>The French Revolution constituted for the conscience of the dominant aristocratic class a fall from...
                </p>
            </div>
            <div class="row mb_30">
                @foreach ($kontents as $konten)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-recent-blog-post">
                            <div class="thumb">
                                <img class="img-fluid" src="{{ asset('gambar/konten/' . $konten->gambar) }}"
                                    alt="post" style="width: 100%; height: 250px; object-fit: cover;">
                            </div>
                            <div class="details">
                                <p>{{ $konten->teks }}</p>
                                <h6 class="date title_color">{{ $konten->created_at->format('d M Y') }}</h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--================ Recent Area  =================-->
@endsection
