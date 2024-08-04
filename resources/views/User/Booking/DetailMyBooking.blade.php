@extends('User.Layout.BaseLayout')
@push('css')
    <style>
        head {
            background-color: #212529;
            color: white;
            text-align: center;
            padding: 30px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        head h1 {
            margin: 0;
            font-size: 2.5rem;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            background: linear-gradient(to right, #ffffff, #f8f9fa);
        }

        .card-header {
            background-color: skyblue;
            color: white;
            font-weight: bold;
            text-align: center;
            padding: 20px;
            border-bottom: 2px solid skyblue;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .card-body {
            padding: 30px;
        }

        .detail-item {
            margin-bottom: 20px;
        }

        .detail-item label {
            font-weight: bold;
            color: #495057;
        }

        .detail-item p {
            margin: 0;
            font-size: 1.1rem;
            color: #212529;
        }

        .btn-custom {
            background-color: #28a745;
            border: none;
            border-radius: 30px;
            padding: 12px 20px;
            color: #fff;
            font-weight: 700;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #218838;
            color: #fff;
            transform: translateY(-2px);
        }

        .room-image {
            max-width: 100%;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .modal-header,
        .modal-footer {
            color: white;
        }

        .modal-body {
            padding: 30px;
        }

        .custom-file-input~.custom-file-label::after {
            content: "Browse";
        }

        .lightbox {
            display: none;
            position: fixed;
            z-index: 9999;
            padding: 50px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.8);
        }

        .lightbox-content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .lightbox img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .star {
            font-size: 1.5em;
            color: gold;
            margin-right: 2px;
        }
    </style>
@endpush
@push('js')
    <script>
        // Display selected image
        document.getElementById('paymentProof').onchange = function(event) {
            var file = event.target.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImage').src = e.target.result;
                    document.getElementById('previewImage').style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        };

        $('.custom-file-input').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass('selected').html(fileName);
        });

        document.querySelectorAll('.payment-img').forEach(function(image) {
            image.onclick = function() {
                var src = this.src;
                var lightbox = document.getElementById('lightbox');
                var lightboxImg = document.getElementById('lightbox-img');
                lightboxImg.src = src;
                lightbox.style.display = 'block';
            };
        });

        document.getElementById('lightbox').onclick = function() {
            this.style.display = 'none';
        };
    </script>
@endpush
@section('content')
    <div class="head">
        <h1>Detail Pesanan</h1>
    </div>

    <div class="container pt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        Detail Pesanan
                    </div>
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
                    <div class="card-body">
                        <div class="detail-item">
                            <label for="roomNumber">Nomor Kamar:</label>
                            <p id="roomNumber">Kamar {{ $booking->kamar->no_kamar }}</p>
                        </div>
                        <div class="detail-item">
                            <label for="name">Nama:</label>
                            <p id="name">{{ $booking->user->nama_lengkap }}</p>
                        </div>
                        <div class="detail-item">
                            <label for="email">Email:</label>
                            <p id="email">{{ $booking->user->email }}</p>
                        </div>
                        <div class="detail-item">
                            <label for="phone">No Telepon:</label>
                            <p id="phone">{{ $booking->user->phone }}</p>
                        </div>
                        <div class="detail-item">
                            <label for="date">Tanggal Check-in:</label>
                            <p id="date">{{ $booking->check_in }}</p>
                        </div>
                        <div class="detail-item">
                            <label for="date">Tanggal Check-out:</label>
                            <p id="date">{{ $booking->check_out }}</p>
                        </div>
                        <div class="detail-item">
                            <label for="catatan">Catatan:</label>
                            @if ($booking->catatan == null)
                                <p id="catatan">(not set)</p>
                            @else
                                <p id="catatan">{{ $booking->catatan }}</p>
                            @endif
                        </div>
                        <div class="detail-item">
                            <label for="rating">Rating:</label>
                            @if ($booking->rating == null)
                                <p id="rating">(not set)</p>
                            @else
                                <p id="rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $booking->rating)
                                            <span class="star">&#9733;</span>
                                        @else
                                            <span class="star">&#9734;</span>
                                        @endif
                                    @endfor
                                    ({{ $booking->rating }}.0)
                                </p>
                            @endif
                        </div>
                        <div class="detail-item">
                            <label for="status">Status:</label>
                            <p id="status">
                                @if ($booking->status == 'Menunggu Konfirmasi')
                                    <span class="text-warning">{{ $booking->status }}</span>
                                @elseif ($booking->status == 'Ditolak')
                                    <span class="text-danger">{{ $booking->status }}</span>
                                @elseif ($booking->status == 'Disetujui')
                                    <span class="text-success">{{ $booking->status }}</span>
                                @else
                                    {{ $booking->status }}
                                @endif
                            </p>
                        </div>
                        <div class="detail-item">
                            <label for="pembayaran">Bukti Pembayaran</label> (<small class="text-danger">Pembayaran dapat
                                dilakukan 1x</small>)
                            <br>
                            @if ($booking->bukti_pembayaran == null)
                                <p id="pembayaran">Belum Dibayar</p>
                            @else
                                <img class="img-fluid payment-img"
                                    src="{{ asset('Customer/Bukti_Pembayaran/' . $booking->bukti_pembayaran) }}"
                                    alt="pembayaran" width="300px" height="200px">
                            @endif
                        </div>
                        @if ($booking->status == 'Menunggu Konfirmasi' && $booking->bukti_pembayaran == null)
                            <a href="#" class="btn btn-custom btn-block" data-toggle="modal"
                                data-target="#paymentModal">Bayar Sekarang</a>
                        @else
                            <a href="#" class="btn btn-custom btn-block disabled" data-toggle="modal"
                                data-target="#paymentModal">Bayar Sekarang</a>
                        @endif
                    </div>
                    <div id="lightbox" class="lightbox">
                        <div class="lightbox-content">
                            <img id="lightbox-img" src="" alt="Bukti Pembayaran">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Upload Bukti Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('paymentproof', $booking->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="paymentProof">Pilih Bukti Pembayaran</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="paymentProof" name="paymentProof"
                                    accept="image/*" required>
                                <label class="custom-file-label" for="paymentProof">Choose file...</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <img id="previewImage" class="img-fluid mt-2" style="display: none; max-width: 100%;">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Kirim Bukti Pembayaran</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
