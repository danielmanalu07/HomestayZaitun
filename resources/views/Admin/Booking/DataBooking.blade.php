@extends('Admin.Layout.baselayout')
@section('title')
    Data Booking Users
@endsection
@section('content')
    <div class="card text-center">
        <div class="card-header text-center bg-info">
            Data Pesanan
        </div>
        <div class="card-body bg-gray-50">
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
                        <th>Nomor Kamar</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Jumlah Tamu</th>
                        <th>Total Pembayaran</th>
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
                                <a href="#" class="btn btn-success btn-sm"><i class="fas fa-check"></i></a>
                                <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-times"
                                        aria-hidden="true"></i></a>
                            </td>
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
@endsection
