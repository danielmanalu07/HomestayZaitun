<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use App\Models\Diskon;
use App\Models\Gallery;
use App\Models\Kamar;
use App\Models\KategoriKamar;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    public function ViewRoom()
    {
        $kategoris = KategoriKamar::all();

        foreach ($kategoris as $kategori) {
            $kategori->average_rating = $this->getAverageRating($kategori->id);
        }

        return view('User.Room.ViewRoom', compact('kategoris'));
    }

    private function getAverageRating($kategoriId)
    {
        $averageRating = DB::table('bookings')
            ->join('kamars', 'bookings.id_kamar', '=', 'kamars.id')
            ->where('kamars.id_kategori', $kategoriId)
            ->avg('bookings.rating');

        return $averageRating ? $averageRating : 0;
    }

    public function DetailRoom($kategori)
    {
        $kategoris = KategoriKamar::findOrFail($kategori);
        $kamars = Kamar::where('id_kategori', $kategoris->id)->get();
        $galleries = [];
        foreach ($kamars as $kamar) {
            $galleries[$kamar->id] = Gallery::where('id_kamar', $kamar->id)->get();
        }
        $diskons = [];
        foreach ($kamars as $kamar) {
            $diskons[$kamar->id] = Diskon::where('id_kamar', $kamar->id)->get();
        }
        return view('User.Room.DetailRoom', compact('kamars', 'galleries', 'diskons'));
    }

    public function getImages($id)
    {
        $gallery = Gallery::find($id);
        if (!$gallery) {
            return response()->json([]);
        }

        $images = [
            'gambar_utama' => $gallery->gambar_utama ? asset('gambar/gallery/gambar_utama/' . $gallery->gambar_utama) : null,
            'gambar2' => $gallery->gambar2 ? asset('gambar/gallery/gambar2/' . $gallery->gambar2) : null,
            'gambar3' => $gallery->gambar3 ? asset('gambar/gallery/gambar3/' . $gallery->gambar3) : null,
            'gambar4' => $gallery->gambar4 ? asset('gambar/gallery/gambar4/' . $gallery->gambar4) : null,
        ];

        return response()->json($images);
    }
}
