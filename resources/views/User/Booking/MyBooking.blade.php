@extends('User.Layout.BaseLayout')

@push('css')
    <style>
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .table thead th {
            background-color: #007bff;
            color: white;
        }

        .filter-form {
            margin-bottom: 20px;
        }

        .filter-form .form-group {
            margin-bottom: 0;
        }

        .filter-form label {
            font-weight: bold;
        }

        .rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center;
        }

        .star {
            font-size: 2em;
            color: #ccc;
            cursor: pointer;
            transition: color 0.3s;
        }

        .star.active {
            color: #f39c12;
        }
    </style>
@endpush

@section('content')
    <div class="container my-5 pt-5">
        <h1 class="mb-4">Pesanan Saya</h1>
        <div class="card">
            <div class="card-header text-center">
                Detail Pesanan
            </div>
            <div class="card-body">
                <!-- Filter Form -->
                <div class="filter-form">
                    <form method="GET" action="{{ route('filter.status') }}">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <select class="w-100" name="status" id="status" onchange="this.form.submit()">
                                    <option value="">Semua Status</option>
                                    <option value="Menunggu Konfirmasi"
                                        {{ request('status') == 'Menunggu Konfirmasi' ? 'selected' : '' }}>Menunggu
                                        Konfirmasi
                                    </option>
                                    <option value="Disetujui" {{ request('status') == 'Disetujui' ? 'selected' : '' }}>
                                        Disetujui
                                    </option>
                                    <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak
                                    </option>
                                    <option value="Dibatalkan" {{ request('status') == 'Dibatalkan' ? 'selected' : '' }}>
                                        Dibatalkan
                                    </option>
                                    <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai
                                    </option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Alerts -->
                @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ Session::get('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <!-- Booking Table -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Jumlah Tamu</th>
                            <th>Total Pembayaran</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookings as $key => $booking)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $booking->user->nama_lengkap }}</td>
                                <td>{{ $booking->created_at->format('d M Y') }}</td>
                                <td>{{ $booking->jumlah_orang }}</td>
                                <td>Rp {{ number_format($booking->total_harga) }}</td>
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
                                    <a href="{{ route('detail.mybooking', $booking->id) }}"
                                        class="btn btn-primary btn-sm">Detail Pesanan</a>
                                    @if ($booking->status == 'Menunggu Konfirmasi')
                                        <button class="btn btn-danger btn-sm btn-cancel" data-id="{{ $booking->id }}"
                                            data-toggle="modal" data-target="#cancelModal">Batalkan Pesanan</button>
                                    @else
                                        <button class="btn btn-danger btn-sm disabled">Batalkan Pesanan</button>
                                    @endif
                                    @if ($booking->status == 'Selesai' && $booking->rating == null)
                                        <button type="button" class="btn btn-info btn-sm btn-rate"
                                            data-id="{{ $booking->id }}">Berikan Rating</button>
                                    @else
                                        <button class="btn btn-info btn-sm disabled">Berikan
                                            Rating</button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="7">Tidak Ada Data Pesanan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Rating Modal -->
    <div class="modal fade" id="ratingModal" tabindex="-1" role="dialog" aria-labelledby="ratingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ratingModalLabel">Berikan Rating</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="ratingForm" method="POST" action="">
                        @csrf
                        @method('PUT')
                        <div class="rating">
                            @for ($i = 5; $i >= 1; $i--)
                                <span class="star" data-value="{{ $i }}"
                                    aria-label="Star {{ $i }}">&#9733;</span>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="ratingValue">
                        <div class="form-group mt-3">
                            <label for="catatan">Komentar (Opsional)</label>
                            <textarea name="catatan" id="catatan" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim Rating</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Cancel Modal -->
    <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelModalLabel">Batalkan Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="cancelForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" name="booking_id" id="booking_id">
                        <div class="form-group">
                            <label for="catatan">Alasan Pembatalan</label>
                            <textarea name="catatan" id="catatan" class="form-control" rows="3" required></textarea>
                            @error('catatan')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Batalkan Pesanan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            // Handle cancel button click
            $('.btn-cancel').on('click', function() {
                var bookingId = $(this).data('id');
                $('#booking_id').val(bookingId);
                var formAction = "{{ route('cancel.booking', ':id') }}";
                formAction = formAction.replace(':id', bookingId);
                $('#cancelForm').attr('action', formAction);
            });

            // Handle rating button click
            $('.btn-rate').on('click', function() {
                var bookingId = $(this).data('id');
                var formAction = "{{ route('submit.rating', ':id') }}";
                formAction = formAction.replace(':id', bookingId);
                $('#ratingForm').attr('action', formAction);
                $('#ratingModal').modal('show');
            });

            // Star rating click handler
            $('.star').on('click', function() {
                var value = $(this).data('value');
                $('.star').each(function() {
                    if ($(this).data('value') <= value) {
                        $(this).addClass('active');
                    } else {
                        $(this).removeClass('active');
                    }
                });
                $('#ratingValue').val(value);
            });
        });
    </script>
@endpush
