<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Gallery;
use App\Models\Kamar;
use App\Models\User;
use App\Notifications\BookingNotification;
use App\Notifications\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $galleries = Gallery::all();
            $kamars = Kamar::all();
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
            return view('Admin.Gallery.Index', compact('galleries', 'kamars'));
        } catch (\Throwable $th) {
            Log::error('Error fetching gallery data: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi Kesalahan Menampilkan Data Gallery');
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $kamars = Kamar::all();
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
            return view('Admin.Gallery.Create', compact('kamars'));
        } catch (\Throwable $th) {
            Log::error('Error displaying form creating gallery data: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi Kesalahan Menampilkan Form Pembuatan Data Gallery');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'gambar_utama' => 'required|mimes:png,jpg,jpeg',
                'gambar2' => 'nullable|mimes:png,jpg,jpeg',
                'gambar3' => 'nullable|mimes:png,jpg,jpeg',
                'gambar4' => 'nullable|mimes:png,jpg,jpeg',
                'id_kamar' => 'required|unique:galleries,id_kamar',
            ]);

            $galleries = new Gallery();
            $galleries->id_kamar = $request->id_kamar;

            // Handle file uploads
            if ($request->hasFile('gambar_utama')) {
                $fileName = 'g_utama' . $request->id_kamar . '.' . $request->file('gambar_utama')->extension();
                $filePath = $request->file('gambar_utama')->storeAs('public/gallery/gambar_utama', $fileName);
                $galleries->gambar_utama = str_replace('public/', '', $filePath); // Store relative path
            }

            if ($request->hasFile('gambar2')) {
                $fileName = 'g_2' . $request->id_kamar . '.' . $request->file('gambar2')->extension();
                $filePath = $request->file('gambar2')->storeAs('public/gallery/gambar2', $fileName);
                $galleries->gambar2 = str_replace('public/', '', $filePath); // Store relative path
            }

            if ($request->hasFile('gambar3')) {
                $fileName = 'g_3' . $request->id_kamar . '.' . $request->file('gambar3')->extension();
                $filePath = $request->file('gambar3')->storeAs('public/gallery/gambar3', $fileName);
                $galleries->gambar3 = str_replace('public/', '', $filePath); // Store relative path
            }

            if ($request->hasFile('gambar4')) {
                $fileName = 'g_4' . $request->id_kamar . '.' . $request->file('gambar4')->extension();
                $filePath = $request->file('gambar4')->storeAs('public/gallery/gambar4', $fileName);
                $galleries->gambar4 = str_replace('public/', '', $filePath); // Store relative path
            }

            $galleries->save();
            return redirect('/admin/gallery')->with('success', 'Data Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            Log::error('Error creating gallery data: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi Kesalahan Menyimpan Data Gallery: ' . $th->getMessage());
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
                'gambar_utama' => 'nullable|mimes:png,jpg,jpeg',
                'gambar2' => 'nullable|mimes:png,jpg,jpeg',
                'gambar3' => 'nullable|mimes:png,jpg,jpeg',
                'gambar4' => 'nullable|mimes:png,jpg,jpeg',
                'id_kamar' => 'required',
            ]);

            $galleries = Gallery::findOrFail($id);

            // Handle file uploads
            if ($request->hasFile('gambar_utama')) {
                // Delete the old image from storage if it exists
                if ($galleries->gambar_utama && Storage::exists('public/' . $galleries->gambar_utama)) {
                    Storage::delete('public/' . $galleries->gambar_utama);
                }
                $fileName = 'g_utama' . $request->id_kamar . '.' . $request->file('gambar_utama')->extension();
                $filePath = $request->file('gambar_utama')->storeAs('public/gallery/gambar_utama', $fileName);
                $galleries->gambar_utama = str_replace('public/', '', $filePath); // Store relative path
            }

            if ($request->hasFile('gambar2')) {
                if ($galleries->gambar2 && Storage::exists('public/' . $galleries->gambar2)) {
                    Storage::delete('public/' . $galleries->gambar2);
                }
                $fileName = 'g_2' . $request->id_kamar . '.' . $request->file('gambar2')->extension();
                $filePath = $request->file('gambar2')->storeAs('public/gallery/gambar2', $fileName);
                $galleries->gambar2 = str_replace('public/', '', $filePath); // Store relative path
            }

            if ($request->hasFile('gambar3')) {
                if ($galleries->gambar3 && Storage::exists('public/' . $galleries->gambar3)) {
                    Storage::delete('public/' . $galleries->gambar3);
                }
                $fileName = 'g_3' . $request->id_kamar . '.' . $request->file('gambar3')->extension();
                $filePath = $request->file('gambar3')->storeAs('public/gallery/gambar3', $fileName);
                $galleries->gambar3 = str_replace('public/', '', $filePath); // Store relative path
            }

            if ($request->hasFile('gambar4')) {
                if ($galleries->gambar4 && Storage::exists('public/' . $galleries->gambar4)) {
                    Storage::delete('public/' . $galleries->gambar4);
                }
                $fileName = 'g_4' . $request->id_kamar . '.' . $request->file('gambar4')->extension();
                $filePath = $request->file('gambar4')->storeAs('public/gallery/gambar4', $fileName);
                $galleries->gambar4 = str_replace('public/', '', $filePath); // Store relative path
            }

            $galleries->id_kamar = $request->id_kamar;

            $galleries->save();

            return redirect('/admin/gallery')->with('success', 'Gallery Berhasil Diupdate');
        } catch (\Throwable $th) {
            Log::error('Error updating gallery data: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi Kesalahan Mengupdate Data Gallery: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $gallery = Gallery::findOrFail($id);
            if ($gallery->gambar_utama && Storage::exists('public/' . $gallery->gambar_utama)) {
                Storage::delete('public/' . $gallery->gambar_utama);
            }
            if ($gallery->gambar2 && Storage::exists('public/' . $gallery->gambar2)) {
                Storage::delete('public/' . $gallery->gambar2);
            }
            if ($gallery->gambar3 && Storage::exists('public/' . $gallery->gambar3)) {
                Storage::delete('public/' . $gallery->gambar3);
            }
            if ($gallery->gambar4 && Storage::exists('public/' . $gallery->gambar4)) {
                Storage::delete('public/' . $gallery->gambar4);
            }
            $gallery->delete();
            return redirect()->back()->with('success', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            Log::error('Error deleting gallery data: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi Kesalahan Menghapus Data Gallery : ' . $th->getMessage());
        }
    }
}
