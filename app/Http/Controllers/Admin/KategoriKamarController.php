<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\KategoriKamar;
use App\Models\User;
use App\Notifications\BookingNotification;
use App\Notifications\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class KategoriKamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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
            return view('Admin.KategoriKamar.Index', compact('kategori_kamars'));
        } catch (\Throwable $th) {
            Log::error('Error fetching category rooms: ' . $th->getMessage());
            return redirect()->back()->withErrors('Terjadi kesalahan saat memuat data kategori kamar.');
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
            return view('Admin.KategoriKamar.Create');
        } catch (\Throwable $th) {
            Log::error('Error displaying create form: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menampilkan form penambahan data.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|unique:kategori_kamars,nama',
                'deskripsi' => 'required',
                'gambar' => 'required|mimes:png,jpg,jpeg',
            ]);

            // Generate a unique filename for the image
            $fileName = $request->nama . '.' . $request->file('gambar')->extension();

            // Store the image in the 'public/gambar/kategoriKamar' directory
            $filePath = $request->file('gambar')->storeAs('public/gambar/kategoriKamar', $fileName);

            $kategori = new KategoriKamar();
            $kategori->nama = $request->input('nama');
            $kategori->deskripsi = strip_tags($request->input('deskripsi'));
            $kategori->gambar = str_replace('public/', '', $filePath); // Store path relative to public

            $kategori->save();

            return redirect('/admin/kategori-kamar')->with('success', 'Data Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            Log::error('Error storing category room: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data kategori kamar. Error: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'nama' => 'required|unique:kategori_kamars,nama,' . $id,
                'deskripsi' => 'required',
                'gambar' => 'nullable|mimes:png,jpg,jpeg',
            ]);

            $kategori_kamar = KategoriKamar::findOrFail($id);

            // Check if a new image is uploaded
            if ($request->hasFile('gambar')) {
                // Delete the old image from storage
                if ($kategori_kamar->gambar) {
                    Storage::delete('public/' . $kategori_kamar->gambar);
                }

                // Store the new image
                $filename = $request->nama . '.' . $request->file('gambar')->extension();
                $filePath = $request->file('gambar')->storeAs('public/gambar/kategoriKamar', $filename);
                $kategori_kamar->gambar = str_replace('public/', '', $filePath); // Store path relative to public
            }

            $kategori_kamar->nama = $request->nama;
            $kategori_kamar->deskripsi = $request->deskripsi;

            $kategori_kamar->save();

            return redirect()->back()->with('success', 'Data Berhasil Diupdate');
        } catch (\Throwable $th) {
            Log::error('Error updating category room: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate data kategori kamar. Error: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $kategori_kamar = KategoriKamar::findOrFail($id);
            if ($kategori_kamar->gambar) {
                Storage::delete('public/' . $kategori_kamar->gambar);
            }
            $kategori_kamar->delete();
            return redirect()->back()->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            Log::error('Error deleting category room: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data kategori kamar.');
        }
    }
}
