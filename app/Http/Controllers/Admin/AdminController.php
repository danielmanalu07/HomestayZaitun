<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Carousel;
use App\Models\Content1;
use App\Models\Diskon;
use App\Models\Fasilitas;
use App\Models\Gallery;
use App\Models\Kamar;
use App\Models\KategoriKamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function Login(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                $request->validate([
                    'username' => 'required',
                    'password' => 'required',
                ]);

                if (Auth::guard('admin')->attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) {
                    return redirect()->route('dashboard.admin');
                } else {
                    return redirect()->back()->with('error', 'Username dan Password tidak sesuai');
                }
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th);
        }
        return view('Admin.Login');
    }
    public function Dashboard()
    {
        $kategori_kamars = KategoriKamar::count();
        $fasilitas = Fasilitas::count();
        $carousels = Carousel::count();
        $kamars = Kamar::count();
        $galleries = Gallery::count();
        $konten = Content1::count();
        $diskon = Diskon::count();
        $bookings = Booking::count();
        return view('Admin.Dashboard', compact('kategori_kamars', 'fasilitas', 'carousels', 'kamars', 'galleries', 'konten', 'diskon', 'bookings'));
    }

    public function Logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login.admin')->with('success', 'Logged Out Berhasil');
    }

    public function Profile()
    {
        $admin = Auth::guard('admin')->user();
        return view('Admin.profile', compact('admin'));
    }

    public function UbahPassword(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'confirm_password' => 'required',
        ]);

        $admin = Auth::guard('admin')->user();

        if ($request->input('password') != $request->input('confirm_password')) {
            return redirect()->back()->with('error', "Password Dan Confirmation Password tidak sesuai");
        }
        $admin->password = Hash::make($request->password);
        $admin->save();
        return redirect()->back()->with('success', "Password Berhasil Diubah");

    }

    public function DataBooking()
    {
        $bookings = Booking::all();
        return view('Admin.Booking.DataBooking', compact('bookings'));
    }

    public function filterStatus(Request $request)
    {
        $status = $request->input('status');

        $query = Booking::query();

        if ($status) {
            $query->where('status', $status);
        }

        $bookings = $query->with(['user', 'kamar'])->get();

        return view('Admin.Booking.DataBooking', compact('bookings'));
    }

    public function RejectBooking(Request $request, string $id)
    {
        $request->validate([
            'catatan' => 'required',
        ]);
        $bookings = Booking::find($id);

        $bookings->catatan = $request->input('catatan');
        $bookings->status = 'Ditolak';

        $bookings->save();
        return redirect()->back()->with('success', 'Pesanan Berhasil Ditolak');
    }

    public function ApproveBooking(string $id)
    {
        try {
            $booking = Booking::findOrFail($id);

            if ($booking->status == 'Menunggu Konfirmasi' && $booking->bukti_pembayaran != null) {
                $booking->status = 'Disetujui';
                $kamar = Kamar::findOrFail($booking->id_kamar);
                $kamar->view += $booking->jumlah_orang;
                $kamar->save();
                $booking->save();

                return redirect()->back()->with('success', 'Pesanan Berhasil Disetujui');
            } else {
                return redirect()->back()->with('error', 'Tidak dapat menyetujui pesanan. Pastikan status pesanan adalah "Menunggu Konfirmasi" dan bukti pembayaran sudah ada.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi Kesalahan saat menyetujui pesanan');
        }
    }

    public function CompletedBooking(string $id)
    {
        try {
            $booking = Booking::findOrFail($id);

            if ($booking->status == 'Disetujui') {
                $booking->status = 'Selesai';
                $booking->save();
                return redirect()->back()->with('success', 'Pesanan Berhasil Diselesaikan');
            } else {
                return redirect()->back()->with('error', 'Tidak dapat menyelesaikan pesanan. Pastikan status pesanan adalah "Menunggu Konfirmasi" dan bukti pembayaran sudah ada.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi Kesalahan saat menyelesaikan pesanan');
        }
    }

}
