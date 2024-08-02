<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Diskon;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DiskonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $diskons = Diskon::all();
            $kamars = Kamar::all();
            return view('Admin.Diskon.Index', compact('diskons', 'kamars'));
        } catch (\Throwable $th) {
            Log::error('error displaying data diskon : ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi Kesalahan Menampilkan Data Diskon');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $kamars = Kamar::all();
            return view('Admin.Diskon.Create', compact('kamars'));
        } catch (\Throwable $th) {
            Log::error('error displaying form created data diskon : ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi Kesalahan Menampilkan Form Data Diskon');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'jumlah_diskon' => 'required|numeric',
                'keterangan' => 'required|string',
                'id_kamar' => 'required|unique:diskons,id_kamar',
            ]);

            $diskon = new Diskon();
            $diskon->jumlah_diskon = $request->input('jumlah_diskon');
            $diskon->keterangan = $request->input('keterangan');
            $diskon->id_kamar = $request->input('id_kamar');

            $kamar = Kamar::find($diskon->id_kamar);

            if (!$kamar) {
                return redirect()->back()->with('error', 'Kamar tidak ditemukan');
            }

            $diskons = ($kamar->harga_kamar * $diskon->jumlah_diskon) / 100;
            $harga_baru = $kamar->harga_kamar - $diskons;
            $diskon->harga_baru = $harga_baru;

            $kamar->harga_kamar = $harga_baru;

            $diskon->save();
            $kamar->update();

            return redirect('/admin/diskon')->with('success', 'Data Berhasil Ditambahkan');

        } catch (\Throwable $th) {
            Log::error('error created data diskon : ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi Kesalahan Menyimpan Data Diskon ' . $th->getMessage());
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
            $diskons = Diskon::findOrFail($id);
            $request->validate([
                'jumlah_diskon' => 'required|numeric',
                'keterangan' => 'required|string',
                'id_kamar' => 'nullable|unique:diskons,id_kamar',
            ]);

            $diskons->id_kamar = $request->id_kamar;
            $diskons->jumlah_diskon = $request->jumlah_diskon;
            $diskons->keterangan = $request->keterangan;

            $kamar = Kamar::find($diskons->id_kamar);

            if (!$kamar) {
                return redirect()->back()->with('error', 'Kamar tidak ditemukan');
            }

            $dsk = ($kamar->harga_kamar * $diskons->jumlah_diskon) / 100;
            $harga_baru = $kamar->harga_kamar - $dsk;
            $diskons->harga_baru = $harga_baru;

            $kamar->harga_kamar = $harga_baru;

            $kamar->update();

            $diskons->update();
            return redirect()->back()->with('success', 'Data Berhasil Diupdate');
        } catch (\Throwable $th) {
            Log::error('error updated data diskon : ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi Kesalahan Mengupdate Data Diskon ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $diskons = Diskon::findOrFail($id);
            $kamar = Kamar::find($diskons->id_kamar);
            $kamar->harga_kamar = $diskons->harga_baru / (1 - ($diskons->jumlah_diskon / 100));
            $kamar->update();
            $diskons->delete();
            return redirect()->back()->with('success', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            Log::error('error deelted data diskon : ' . $th->getMessage());
            return redirect()->back()->with('error', 'Terjadi Kesalahan Menghapus Data Diskon ' . $th->getMessage());
        }
    }
}
