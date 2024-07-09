<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriKamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KategoriKamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $kategori_kamars = KategoriKamar::all();
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
            ]);

            $input = $request->all();

            KategoriKamar::create($input);
            return redirect('/admin/kategori-kamar')->with('success', 'Data Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            Log::error('Error storing category room: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data kategori kamar.' . $th->getMessage());
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
            ]);

            $kategori_kamar = KategoriKamar::findOrFail($id);
            $input = $request->all();

            $kategori_kamar->update($input);
            return redirect()->back()->with('success', 'Data Berhasil Diupdate');
        } catch (\Throwable $th) {
            Log::error('Error updating category room: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate data kategori kamar.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $kategori_kamar = KategoriKamar::findOrFail($id);
            $kategori_kamar->delete();
            return redirect()->back()->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            Log::error('Error deleting category room: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data kategori kamar.');
        }
    }
}
