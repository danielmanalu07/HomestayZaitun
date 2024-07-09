<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

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

            if ($request->hasFile('gambar_utama')) {
                $g_utama = 'g_utama' . $request->id_kamar . '.' . $request->file('gambar_utama')->extension();
                $request->file('gambar_utama')->move(public_path('gambar/gallery/gambar_utama'), $g_utama);
            }

            $g_2 = null;
            if ($request->hasFile('gambar2')) {
                $g_2 = 'g_2' . $request->id_kamar . '.' . $request->file('gambar2')->extension();
                $request->file('gambar2')->move(public_path('gambar/gallery/gambar2'), $g_2);
            }

            $g_3 = null;
            if ($request->hasFile('gambar3')) {
                $g_3 = 'g_3' . $request->id_kamar . '.' . $request->file('gambar3')->extension();
                $request->file('gambar3')->move(public_path('gambar/gallery/gambar3'), $g_3);
            }

            $g_4 = null;
            if ($request->hasFile('gambar4')) {
                $g_4 = 'g_4' . $request->id_kamar . '.' . $request->file('gambar4')->extension();
                $request->file('gambar4')->move(public_path('gambar/gallery/gambar4'), $g_4);
            }

            $galleries = new Gallery();
            $galleries->gambar_utama = $g_utama ?? '';
            $galleries->gambar2 = $g_2 ?? '';
            $galleries->gambar3 = $g_3 ?? '';
            $galleries->gambar4 = $g_4 ?? '';
            $galleries->id_kamar = $request->id_kamar;

            $galleries->save();
            return redirect('/admin/gallery')->with('success', 'Data Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            Log::error('Error creating gallery data: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi Kesalahan Menyimpan Data Gallery : ' . $th->getMessage());
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

            if ($request->hasFile('gambar_utama')) {
                File::delete(public_path('gambar/gallery/gambar_utama/') . $request->gambar_utama);
                $g_utama = 'g_utama' . $request->id_kamar . '.' . $request->file('gambar_utama')->extension();
                $request->file('gambar_utama')->move(public_path('gambar/gallery/gambar_utama'), $g_utama);
                $galleries->gambar_utama = $g_utama;
            }

            $g_2 = null;
            if ($request->hasFile('gambar2')) {
                File::delete(public_path('gambar/gallery/gambar2/') . $request->gambar2);
                $g_2 = 'g_2' . $request->id_kamar . '.' . $request->file('gambar2')->extension();
                $request->file('gambar2')->move(public_path('gambar/gallery/gambar2'), $g_2);
                $galleries->gambar2 = $g_2;
            }

            $g_3 = null;
            if ($request->hasFile('gambar3')) {
                File::delete(public_path('gambar/gallery/gambar3/') . $request->gambar3);
                $g_3 = 'g_3' . $request->id_kamar . '.' . $request->file('gambar3')->extension();
                $request->file('gambar3')->move(public_path('gambar/gallery/gambar3'), $g_3);
                $galleries->gambar3 = $g_3;
            }

            $g_4 = null;
            if ($request->hasFile('gambar4')) {
                File::delete(public_path('gambar/gallery/gambar4/') . $request->gambar4);
                $g_4 = 'g_4' . $request->id_kamar . '.' . $request->file('gambar4')->extension();
                $request->file('gambar4')->move(public_path('gambar/gallery/gambar4'), $g_4);
                $galleries->gambar4 = $g_4;
            }

            $galleries->id_kamar = $request->id_kamar;

            $galleries->update();

            return redirect('/admin/gallery')->with('success', 'Gallery Berhasil Diupdate');
        } catch (\Throwable $th) {
            Log::error('Error updating gallery data: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi Kesalahan Mengupdate Data Gallery : ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $gallery = Gallery::findOrFail($id);
            $gallery->delete();
            return redirect()->back()->with('success', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            Log::error('Error deleting gallery data: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi Kesalahan Menghapus Data Gallery : ' . $th->getMessage());
        }
    }
}
