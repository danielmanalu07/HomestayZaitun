<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class BookingController extends Controller
{
    public function BookingView(Request $request)
    {
        return view('User.Room.Booking');
    }
}
