<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Fasilitas;
use App\Models\User;
use App\Notifications\BookingNotification;
use App\Notifications\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $fasilitas = Fasilitas::all();

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
            return view('Admin.Fasilitas.Index', compact('fasilitas'));
        } catch (\Throwable $th) {
            Log::error('Error fetching fasilitas: ' . $th->getMessage());
            return redirect()->back()->withErrors('Terjadi kesalahan saat memuat data fasilitas.');
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
            return view('Admin.Fasilitas.Create');
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
                'nama' => 'required|unique:fasilitas,nama',
                'deskripsi' => 'required',
                'gambar' => 'required|mimes:png,jpg,jpeg',
            ]);

            $fileName = $request->nama . '.' . $request->file('gambar')->extension();

            $filePath = $request->file('gambar')->storeAs('public/fasilitas', $fileName);

            $fasilitas = new Fasilitas();
            $fasilitas->nama = $request->input('nama');
            $fasilitas->deskripsi = $request->input('deskripsi');
            $fasilitas->gambar = str_replace('public/', '', $filePath);
            $fasilitas->save();

            return redirect('/admin/fasilitas')->with('success', 'Data Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            Log::error('Error storing data fasilitas: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data fasilitas. Error: ' . $th->getMessage());
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
        //tr
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'nama' => 'required|unique:fasilitas,nama,' . $id,
                'deskripsi' => 'required',
                'gambar' => 'nullable|mimes:png,jpg,jpeg',
            ]);

            $fasilitas = Fasilitas::findOrFail($id);

            if ($request->hasFile('gambar')) {
                // Delete the old image from storage if it exists
                if ($fasilitas->gambar && Storage::exists('public/' . $fasilitas->gambar)) {
                    Storage::delete('public/' . $fasilitas->gambar);
                }

                // Store the new image in the 'fasilitas' directory inside 'storage/app/public'
                $fileName = $request->nama . '.' . $request->file('gambar')->extension();
                $filePath = $request->file('gambar')->storeAs('public/fasilitas', $fileName);

                // Update the 'gambar' field with the new file name
                $fasilitas->gambar = str_replace('public/', '', $filePath);
            }

            $fasilitas->nama = $request->nama;
            $fasilitas->deskripsi = $request->deskripsi;

            $fasilitas->update();

            return redirect('/admin/fasilitas')->with('success', 'Fasilitas Berhasil Diupdate');
        } catch (\Throwable $th) {
            Log::error('Error updating data fasilitas: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate data fasilitas. Error: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $fasilitas = Fasilitas::findOrFail($id);
            if ($fasilitas->gambar && Storage::exists('public/' . $fasilitas->gambar)) {
                Storage::delete('public/' . $fasilitas->gambar);
            }
            $fasilitas->delete();
            return redirect()->back()->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            Log::error('Error deleting Fasilitas: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data fasilitas.');
        }
    }
}
