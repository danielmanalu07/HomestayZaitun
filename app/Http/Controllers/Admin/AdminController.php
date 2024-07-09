<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use App\Models\Fasilitas;
use App\Models\Kamar;
use App\Models\KategoriKamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function Login(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                $request->validate([
                    'username' => 'required',
                    'password' => 'required',
                ]);

                if (Auth::guard('admin')->attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) {
                    return redirect()->route('dashboard.admin');
                } else {
                    return redirect()->back()->with('error', 'Username dan Password tidak sesuai');
                }
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th);
        }
        return view('Admin.Login');
    }
    public function Dashboard()
    {
        $kategori_kamars = KategoriKamar::count();
        $fasilitas = Fasilitas::count();
        $carousels = Carousel::count();
        $kamars = Kamar::count();
        return view('Admin.Dashboard', compact('kategori_kamars', 'fasilitas', 'carousels', 'kamars'));
    }

    public function Logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login.admin')->with('success', 'Logged Out Berhasil');
    }
}
