<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class Kontent1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $konten = Content1::all();
            return view('Admin.Konten1.Index', compact('konten'));
        } catch (\Throwable $th) {
            Log::error('Error displaying konten data: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi Kesalahan Saat Menampilkan Data Konten');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('Admin.Konten1.Create');
        } catch (\Throwable $th) {
            Log::error('Error displaying form creating konten data: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi Kesalahan Saat Menampilkan Form Create Data Konten');
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
                'teks' => 'required',
            ]);

            $fileName = time() . '.' . $request->file('gambar')->extension();
            $request->file('gambar')->move(public_path('gambar/konten'), $fileName);

            $konten1 = new Content1();
            $konten1->gambar = $fileName;
            $konten1->teks = $request->input('teks');

            $konten1->save();
            return redirect('/admin/konten1')->with('success', 'Data Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            Log::error('Error created konten data: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi Kesalahan Saat Menyimpan Data Konten');
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
                'gambar' => 'nullable|mimes:png,jpg,jpeg',
                'teks' => 'required',
            ]);

            $konten = Content1::findOrFail($id);

            if ($request->hasFile('gambar')) {
                File::delete(public_path('gambar/konten/' . $konten->gambar));
                $fileName = time() . '.' . $request->file('gambar')->extension();
                $request->file('gambar')->move(public_path('gambar/konten'), $fileName);
                $konten->gambar = $fileName;
            }

            $konten->teks = $request->teks;

            $konten->update();

            return redirect('/admin/konten1')->with('success', 'Konten Berhasil Diupdate');
        } catch (\Throwable $th) {
            Log::error('Error updating data konten: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate data konten. Error: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $konten = Content1::findOrFail($id);
            $konten->delete();
            return redirect()->back()->with('success', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            Log::error('Error deleting Konten: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data Konten.');
        }
    }
}
