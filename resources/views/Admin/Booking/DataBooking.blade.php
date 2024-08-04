@extends('Admin.Layout.baselayout')
@section('title')
    Data Booking Users
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <style>
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
    </style>
@endpush
@section('content')
    <div class="card text-center">
        <div class="card-header text-center bg-info">
            Data Pesanan
        </div>
        <div class="card-body bg-gray-50">
            @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ Session::get('error') }}
                </div>
            @endif
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif

            <!-- Filter Form -->
            <form method="GET" action="{{ route('bookings.filter') }}">
                <div class="form-group row">
                    <label for="status" class="col-md-2 col-form-label text-md-right">Filter Status:</label>
                    <div class="col-md-6">
                        <select class="form-control" name="status" id="status" onchange="this.form.submit()">
                            <option value="">All</option>
                            <option value="Menunggu Konfirmasi"
                                {{ request('status') == 'Menunggu Konfirmasi' ? 'selected' : '' }}>Menunggu Konfirmasi
                            </option>
                            <option value="Disetujui" {{ request('status') == 'Disetujui' ? 'selected' : '' }}>Disetujui
                            </option>
                            <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            <option value="Dibatalkan" {{ request('status') == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan
                            </option>
                            <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai
                            </option>
                        </select>
                    </div>
                </div>
            </form>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Nomor Kamar</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Jumlah Tamu</th>
                        <th>Total Pembayaran</th>
                        <th>Bukti Pembayaran</th>
                        <th>Status</th>
                        <th>Catatan</th>
                        <th>Rating</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bookings as $key => $booking)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $booking->user->nama_lengkap }}</td>
                            <td>{{ $booking->kamar->no_kamar }}</td>
                            <td>{{ $booking->check_in }}</td>
                            <td>{{ $booking->check_out }}</td>
                            <td>{{ $booking->jumlah_orang }}</td>
                            <td>Rp {{ number_format($booking->total_harga) }}</td>
                            <td>
                                @if ($booking->bukti_pembayaran == null)
                                    <p id="pembayaran">Belum Dibayar</p>
                                @else
                                    <div class="zoomable-image">
                                        <img class="img-fluid payment-img"
                                            src="{{ asset('Customer/Bukti_Pembayaran/' . $booking->bukti_pembayaran) }}"
                                            alt="pembayaran" width="300px" height="200px">
                                    </div>
                                @endif
                            </td>
                            <td>
                                @if ($booking->status == 'Menunggu Konfirmasi')
                                    <span class="text-warning">{{ $booking->status }}</span>
                                @elseif ($booking->status == 'Ditolak')
                                    <span class="text-danger">{{ $booking->status }}</span>
                                @elseif ($booking->status == 'Dibatalkan')
                                    <span class="text-danger">{{ $booking->status }}</span>
                                @elseif ($booking->status == 'Disetujui')
                                    <span class="text-success">{{ $booking->status }}</span>
                                @else
                                    {{ $booking->status }}
                                @endif
                            </td>
                            <td>
                                @if ($booking->catatan == null)
                                    (not set)
                                @else
                                    {{ $booking->catatan }}
                                @endif
                            </td>
                            <td>
                                @if ($booking->rating == null)
                                    (not set)
                                @else
                                    {{ $booking->rating }}
                                @endif
                            </td>
                            <td>
                                <form method="POST" action="{{ route('approve.booking', $booking->id) }}">
                                    @csrf
                                    @method('PUT')
                                    @if ($booking->status == 'Menunggu Konfirmasi' && $booking->bukti_pembayaran != null)
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fas fa-check"></i> Konfirmasi
                                        </button>
                                    @else
                                        <a href="#" class="btn btn-success btn-sm disabled"><i
                                                class="fas fa-check"></i>
                                            Konfirmasi</a>
                                    @endif
                                </form>
                                @if ($booking->status == 'Menunggu Konfirmasi')
                                    <button type="button" class="btn btn-danger btn-sm my-2 reject-btn"
                                        data-id="{{ $booking->id }}" data-toggle="modal" data-target="#rejectModal">
                                        <i class="fa fa-times" aria-hidden="true"></i> Tolak
                                    </button>
                                @else
                                    <a href="#" class="btn btn-danger btn-sm my-2 disabled"><i class="fa fa-times"
                                            aria-hidden="true"></i> Tolak</a>
                                @endif
                                @if ($booking->status == 'Ditolak' || $booking->status == 'Menunggu Konfirmasi' || $booking->status == 'Dibatalkan')
                                    <a href="#" class="btn btn-info btn-sm disabled" title="Not available">
                                        <i class="fa fa-flag-checkered" aria-hidden="true"></i> Complete
                                    </a>
                                @else
                                    <form method="POST" action="{{ route('complete.booking', $booking->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-info btn-sm">
                                            <i class="fa fa-flag-checkered" aria-hidden="true"></i> Complete
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="12">Tidak Ada Data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for rejection reason -->
    <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectModalLabel">Tolak Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="rejectForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" name="booking_id" id="booking_id">
                        <div class="form-group">
                            <label for="catatan">Alasan Penolakan</label>
                            <textarea name="catatan" id="catatan" class="form-control" rows="3" required></textarea>
                            @error('catatan')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Tolak Pesanan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="lightbox" class="lightbox">
        <div class="lightbox-content">
            <img id="lightbox-img" src="" alt="Bukti Pembayaran">
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script>
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

        $(document).ready(function() {
            $('.reject-btn').on('click', function() {
                var bookingId = $(this).data('id');
                $('#booking_id').val(bookingId);
                var formAction = "{{ route('reject.booking', ':id') }}";
                formAction = formAction.replace(':id', bookingId);
                $('#rejectForm').attr('action', formAction);
            });
        });
    </script>
@endpush
