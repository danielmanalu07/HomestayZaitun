<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $fasilitas = Fasilitas::all();
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
            $request->file('gambar')->move(public_path('gambar/fasilitas'), $fileName);

            $fasilitas = new Fasilitas();
            $fasilitas->nama = $request->input('nama');
            $fasilitas->deskripsi = $request->input('deskripsi');
            $fasilitas->gambar = $fileName;
            $fasilitas->save();
            return redirect('/admin/fasilitas')->with('success', 'Data Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            Log::error('Error storing data fasilitas: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data fasilitas.' . 'Error : ' . $th->getMessage());
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
