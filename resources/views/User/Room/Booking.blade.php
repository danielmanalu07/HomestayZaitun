@extends('User.Layout.BaseLayout')
@push('css')
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Arial', sans-serif;
        }

        .booking-container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 30px;
            padding-top: 5%;
            margin-top: 2%;
            background: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            border-radius: 15px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .booking-images {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-bottom: 20px;
            width: 45%;
        }

        .booking-images img {
            width: 48%;
            margin-bottom: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .booking-images img:hover {
            transform: scale(1.05);
        }

        .booking-title {
            text-align: center;
            margin-bottom: 30px;
            width: 100%;
        }

        .booking-title h1 {
            color: #333;
            font-size: 32px;
            font-weight: bold;
        }

        .booking-form {
            flex: 1;
            max-width: 500px;
            padding: 20px;
            background: #fafafa;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .booking-form .form-group {
            margin-bottom: 20px;
        }

        .booking-form .form-control {
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .booking-form .btn {
            width: 100%;
            padding: 15px;
            border-radius: 5px;
            background-color: #28a745;
            border: none;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .booking-form .btn:hover {
            background-color: #218838;
        }
    </style>
@endpush
@section('content')
    <div class="container booking-container">
        <div class="booking-title">
            <h1>Pesan Sekarang</h1>
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
        </div>
        <div class="booking-images">
            @foreach ($gallery as $image)
                <img src="{{ asset('gambar/gallery/gambar_utama/' . $image->gambar_utama) }}" alt="Room Image">
                <img src="{{ asset('gambar/gallery/gambar2/' . $image->gambar2) }}" alt="Room Image">
                <img src="{{ asset('gambar/gallery/gambar3/' . $image->gambar3) }}" alt="Room Image">
                <img src="{{ asset('gambar/gallery/gambar4/' . $image->gambar4) }}" alt="Room Image">
            @endforeach
        </div>
        <form id="bookingForm" class="booking-form" action="{{ route('create.booking') }}" method="POST">
            @csrf
            <input type="hidden" class="form-control" id="id_user" name="id_user" value="{{ $user->id }}">
            <input type="hidden" class="form-control" id="id_kamar" name="id_kamar" value="{{ $kamar->id }}">
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" class="form-control" id="name" name="name" required readonly
                    value="{{ $user->nama_lengkap ?? '' }}">
            </div>
            <div class="form-group">
                <label for="phone">No Telepon</label>
                <input type="text" class="form-control" id="phone" name="phone" required readonly
                    value="{{ $user->phone }}">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required readonly
                    value="{{ $user->email ?? '' }}">
            </div>
            <div class="form-group">
                <label for="room_number">Nomor Kamar</label>
                <input type="text" class="form-control" id="room_number" name="room_number" required readonly
                    value="{{ $kamar->no_kamar }}">
            </div>
            <div class="form-group">
                <label for="check_in">Tanggal Check In</label>
                <input type="date" class="form-control" id="check_in" name="check_in">
                @error('check_in')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="check_out">Tanggal Check Out</label>
                <input type="date" class="form-control" id="check_out" name="check_out">
                @error('check_out')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="jumlah_orang">Jumlah Orang</label>
                <input type="number" class="form-control" id="jumlah_orang" name="jumlah_orang">
                @error('jumlah_orang')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Pesan</button>
        </form>
    </div>
@endsection
