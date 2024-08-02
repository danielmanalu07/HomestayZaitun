@extends('User.Layout.BaseLayout')
@section('css')
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Arial', sans-serif;
        }

        .booking-container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 30px;
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
    background-color: #f5f5f5;
    font-family: 'Arial', sans-serif;
    }
    .booking-container {
    max-width: 1200px;
    margin: 50px auto;
    padding: 30px;
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
    box-shadow: 0
@endsection
@section('content')

    <body>
        <div class="container booking-container">
            <div class="booking-title">
                <h1>Pesan Sekarang</h1>
            </div>
            <div class="booking-images">
                <img src="classic_room.jpg" alt="Room Image 1">
                <img src="grand_deluxe_room.jpg" alt="Room Image 2">
                <img src="ultra_superior_room.jpg" alt="Room Image 3">
                <img src="classic_room.jpg" alt="Room Image 4">
            </div>
            <form id="bookingForm" class="booking-form">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="phone">No Telepon</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="room_id">Nomor Kamar</label>
                    <input type="text" class="form-control" id="room_id" name="room_id" required>
                </div>
                <div class="form-group">
                    <label for="checkin_date">Tanggal Check In</label>
                    <input type="date" class="form-control" id="checkin_date" name="checkin_date" required>
                </div>
                <div class="form-group">
                    <label for="checkout_date">Tanggal Check Out</label>
                    <input type="date" class="form-control" id="checkout_date" name="checkout_date" required>
                </div>
                <div class="form-group">
                    <label for="number_of_guests">Jumlah Orang</label>
                    <input type="number" class="form-control" id="number_of_guests" name="number_of_guests" required>
                </div>
                <button type="submit" class="btn btn-success">Pesan</button>
            </form>
        </div>
    </body>
@endsection
