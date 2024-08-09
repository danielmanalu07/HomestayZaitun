<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Carousel;
use App\Models\User;
use App\Notifications\BookingNotification;
use App\Notifications\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $carousels = Carousel::all();
            $users = User::get();

            foreach ($users as $user) {
                $notif = Auth::guard('admin')->user()->notifications()
                    ->where('data->id', $user->id)
                    ->first();

                if (!$notif) {
                    $notification = new UserNotification($user);
                    Auth::guard('admin')->user()->notify($notification);
                }
            }

            $bkgs = Booking::get();
            foreach ($bkgs as $booking) {
                $notif = Auth::guard('admin')->user()->notifications()
                    ->where('data->id', $booking->id)
                    ->first();

                if (!$notif) {
                    $notification = new BookingNotification($booking);
                    Auth::guard('admin')->user()->notify($notification);
                }
            }
            return view('Admin.Carousel.Index', compact('carousels'));
        } catch (\Throwable $th) {
            Log::error('Error fetching fasilitas: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi Kesalahan Menampilkan data Carousel');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $users = User::get();

            foreach ($users as $user) {
                $notif = Auth::guard('admin')->user()->notifications()
                    ->where('data->id', $user->id)
                    ->first();

                if (!$notif) {
                    $notification = new UserNotification($user);
                    Auth::guard('admin')->user()->notify($notification);
                }
            }

            $bkgs = Booking::get();
            foreach ($bkgs as $booking) {
                $notif = Auth::guard('admin')->user()->notifications()
                    ->where('data->id', $booking->id)
                    ->first();

                if (!$notif) {
                    $notification = new BookingNotification($booking);
                    Auth::guard('admin')->user()->notify($notification);
                }
            }
            return view('Admin.Carousel.Create');
        } catch (\Throwable $th) {
            Log::error('Error display form created fasilitas: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi Kesalahan Menampilkan form pembuatan Carousel');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'gambar' => 'required|mimes:png,jpg,jpeg',
                'text' => 'nullable',
            ]);
            $fileName = time() . '.' . $request->file('gambar')->extension();
            $request->file('gambar')->move(public_path('gambar/carousel'), $fileName);

            $carousel = new Carousel();
            $carousel->text = $request->input('text');
            $carousel->gambar = $fileName;
            $carousel->save();
            return redirect('/admin/carousel')->with('success', 'Data Berhasil Ditambah');
        } catch (\Throwable $th) {
            Log::error('Error creating fasilitas: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi Kesalahan Penyimpanan Data Carousel' . $th->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'gambar' => 'nullable|mimes:png,jpg,jpeg' . $id,
                'text' => 'nullable',
            ]);

            $carousel = Carousel::findOrFail($id);
            if ($request->hasFile('gambar')) {
                $path = public_path('gambar/carousel/');
                File::delete($path . $carousel->gambar);
                $file = time() . '.' . $request->file('gambar')->extension();
                $request->file('gambar')->move($path, $file);
                $carousel->gambar = $file;
            }

            $carousel->text = $request->text;

            $carousel->update();
            return redirect('/admin/carousel')->with('success', 'Carousel Berhasil diupdate');
        } catch (\Throwable $th) {
            Log::error('Error updating data carousel: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate data carousel' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $carousels = Carousel::findOrFail($id);
            $carousels->delete();
            return redirect()->back()->with('success', 'Data Berhasil dihapus');
        } catch (\Throwable $th) {
            Log::error('Error deleting carousel: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data carousel.');
        }
    }
}
