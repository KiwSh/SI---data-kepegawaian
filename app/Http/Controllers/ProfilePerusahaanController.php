<?php

namespace App\Http\Controllers;

use App\Models\ProfilePerusahaan;
use Illuminate\Http\Request;

class ProfilePerusahaanController extends Controller
{
    // Menampilkan halaman profil perusahaan
    public function index()
    {
        $profile = ProfilePerusahaan::first(); // Ambil data pertama
        return view('profile', compact('profile'));

    }
    

    // Menyimpan data profil perusahaan
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'bidang' => 'required|string',
        ]);

        // Update atau simpan data profil
        ProfilePerusahaan::updateOrCreate(
            ['id' => 1],
            [
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'bidang' => $request->bidang,
            ]
        );

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui.');
    }
}
