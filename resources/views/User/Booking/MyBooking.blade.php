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
                                    @elseif ($booking->status == 'Disetujui')
                                        <span class="text-success">{{ $booking->status }}</span>
                                    @else
                                        {{ $booking->status }}
                                    @endif
                                </td>
                                <td><a href="#" class="btn btn-primary btn-sm">Detail Pesanan</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="6">Tidak Ada Data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
