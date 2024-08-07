<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Gallery;
use App\Models\Kamar;
use App\Notifications\BookingNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function BookingView($roomId)
    {
        $kamar = Kamar::findOrFail($roomId);

        $gallery = Gallery::where('id_kamar', $roomId)->get();

        $user = Auth::guard('user')->user();

        $bkgs = Booking::where('status', 'Disetujui')->get();
        foreach ($bkgs as $booking) {
            $notif = Auth::guard('user')->user()->notifications()
                ->where('data->id', $booking->id)
                ->first();

            if (!$notif) {
                $notification = new BookingNotification($booking);
                Auth::guard('user')->user()->notify($notification);
            }
        }

        return view('User.Room.Booking', compact('kamar', 'gallery', 'user'));
    }

    public function CreateBooking(Request $request)
    {
        try {
            $request->validate([
                'id_kamar' => 'required',
                'check_in' => 'required|date',
                'check_out' => 'required|date',
                'jumlah_orang' => 'required|integer',
            ]);

            $idKamar = $request->input('id_kamar');
            $checkIn = $request->input('check_in');
            $checkOut = $request->input('check_out');
            $jumlahOrang = $request->input('jumlah_orang');
            $today = now()->format('Y-m-d');

            if ($checkIn == $checkOut) {
                return redirect()->back()->with('error', 'Check-in dan check-out tidak bisa di tanggal yang sama.');
            }

            if ($checkIn < $today || $checkOut < $today) {
                return redirect()->back()->with('error', 'Tidak bisa melakukan check-in/check-out di tanggal yang sudah lewat.');
            }

            $existingBooking = Booking::where('id_kamar', $idKamar)
                ->whereIn('status', ['Belum Dikonfirmasi', 'Disetujui'])
                ->where(function ($query) use ($checkIn, $checkOut) {
                    $query->whereBetween('check_in', [$checkIn, $checkOut])
                        ->orWhereBetween('check_out', [$checkIn, $checkOut])
                        ->orWhere(function ($query) use ($checkIn, $checkOut) {
                            $query->where('check_in', '<=', $checkIn)
                                ->where('check_out', '>=', $checkOut);
                        });
                })
                ->exists();

            if ($existingBooking) {
                return redirect()->back()->with('error', 'Kamar sudah dipesan pada tanggal tersebut.');
            }

            $bookings = new Booking();
            $bookings->id_user = Auth::guard('user')->user()->id;
            $bookings->id_kamar = $idKamar;
            $bookings->check_in = $checkIn;
            $bookings->check_out = $checkOut;
            $bookings->jumlah_orang = $jumlahOrang;
            $bookings->total_harga = $bookings->kamar->harga_kamar * (new \DateTime($checkOut))->diff(new \DateTime($checkIn))->days;

            if ($jumlahOrang > $bookings->kamar->kapasitas) {
                return redirect()->back()->with('error', 'Tidak dapat melakukan pesanan karena jumlah orang melebihi kapasitas kamar.');
            }

            $bookings->save();

            return redirect()->route('mybooking')->with('success', 'Berhasil melakukan pesanan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi Kesalahan saat melakukan pesanan: ' . $th->getMessage());
        }
    }

    public function DetailBooking($id)
    {
        $booking = Booking::findOrFail($id);

        $bkgs = Booking::where('status', 'Disetujui')->get();
        foreach ($bkgs as $booking) {
            $notif = Auth::guard('user')->user()->notifications()
                ->where('data->id', $booking->id)
                ->first();

            if (!$notif) {
                $notification = new BookingNotification($booking);
                Auth::guard('user')->user()->notify($notification);
            }
        }
        return view('User.Booking.DetailMyBooking', compact('booking'));
    }

    public function PaymentProof(Request $request, string $id)
    {
        $request->validate([
            'paymentProof' => 'required|mimes:png,jpg,jpeg',
        ]);

        try {
            $booking = Booking::findOrFail($id);
            if ($request->hasFile('paymentProof')) {
                $file = $request->file('paymentProof');
                $fileName = 'payment_' . $id . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('Customer/Bukti_Pembayaran'), $fileName);

                $booking->bukti_pembayaran = $fileName;
                $booking->save();

                return redirect()->back()->with('success', 'Berhasil Mengupload Bukti Pembayaran');
            } else {
                return redirect()->back()->with('error', 'File tidak ditemukan');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi Kesalahan Mengupload Bukti Pembayaran');
        }
    }

}
