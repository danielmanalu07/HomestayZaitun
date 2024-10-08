<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Gallery;
use App\Models\Kamar;
use App\Models\KategoriKamar;
use App\Models\User;
use App\Notifications\BookingNotification;
use App\Notifications\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $kategori_kamars = KategoriKamar::all();
            $kamars = Kamar::all();
            $galleries = [];
            foreach ($kamars as $kamar) {
                $galleries[$kamar->id] = Gallery::where('id_kamar', $kamar->id)->get();
            }

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

            return view('Admin.Kamar.Index', compact('kamars', 'kategori_kamars', 'galleries'));
        } catch (\Throwable $th) {
            Log::error('Error fetching kamars data: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi Kesalahan Menampilkan Data Kamar' . $th->getMessage());
        }
    }

    public function getImages($id)
    {
        $gallery = Gallery::where('id_kamar', $id)->first();
        if (!$gallery) {
            return response()->json([]);
        }

        $images = [
            'gambar_utama' => $gallery->gambar_utama ? Storage::url($gallery->gambar_utama) : null,
            'gambar2' => $gallery->gambar2 ? Storage::url($gallery->gambar2) : null,
            'gambar3' => $gallery->gambar3 ? Storage::url($gallery->gambar3) : null,
            'gambar4' => $gallery->gambar4 ? Storage::url($gallery->gambar4) : null,
        ];

        return response()->json($images);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $kategori_kamars = KategoriKamar::all();

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

            return view('Admin.Kamar.Create', compact('kategori_kamars'));
        } catch (\Throwable $th) {
            Log::error('Error displaying form create kamars data: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi Kesalahan Menampilkan Form Pembuatan Data Kamar');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'no_kamar' => 'required|unique:kamars,no_kamar',
                'harga_kamar' => 'required',
                'kapasitas' => 'required',
                'id_kategori' => 'required',
            ]);

            $kamars = new Kamar();
            $kamars->no_kamar = $request->input('no_kamar');
            $kamars->harga_kamar = $request->input('harga_kamar');
            $kamars->kapasitas = $request->input('kapasitas');
            $kamars->id_kategori = $request->input('id_kategori');
            $kamars->status = 'Tersedia';
            $kamars->view = 0;

            $kamars->save();
            return redirect('/admin/kamar')->with('success', 'Data Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            Log::error('Error created kamars data: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi Kesalahan Menyimpan Data Kamar ' . $th->getMessage());
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
                'no_kamar' => 'required|unique:kamars,no_kamar',
                'harga_kamar' => 'required',
                'kapasitas' => 'required',
                'id_kategori' => 'required',
            ]);

            $kamars = Kamar::findOrFail($id);
            $kamars->update($request->all());

            return redirect()->back()->with('success', 'Data Berhasil Diupdate');
        } catch (\Throwable $th) {
            Log::error('Error updated kamars data: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi Kesalahan Mengupdate Data Kamar ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $kamars = Kamar::findOrFail($id);
            $kamars->delete();
            return redirect()->back()->with('success', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            Log::error('Error deleted kamars data: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi Kesalahan Menghapus Data Kamar ' . $th->getMessage());
        }
    }
}
