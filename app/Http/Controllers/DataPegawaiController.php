<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Jabatan; // Import model Jabatan
use Illuminate\Http\Request;

class DataPegawaiController extends Controller
{
    public function index()
{
    $pegawais = Pegawai::with('jabatan')->get(); // Mengambil data pegawai beserta relasi jabatan
    return view('pages.datapegawai', compact('pegawais'));
}


    public function create()
    {
        $jabatans = Jabatan::all(); // Ambil semua data jabatan
        return view('pages.createpegawai', compact('jabatans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:pegawais',
            'nama' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'tb_jabatan_id' => 'required|exists:tb_jabatan,id',
            'mulai_kerja' => 'required|date',
            'lama_kerja' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $pegawai = new Pegawai();
        $pegawai->nik = $request->nik;
        $pegawai->nama = $request->nama;
        $pegawai->tanggal_lahir = $request->tanggal_lahir;
        $pegawai->alamat = $request->alamat;
        $pegawai->tb_jabatan_id = $request->tb_jabatan_id;
        $pegawai->mulai_kerja = $request->mulai_kerja;
        $pegawai->lama_kerja = $request->lama_kerja;
    
        // Hitung tanggal selesai kerja
        $pegawai->selesai_kerja = \Carbon\Carbon::parse($request->mulai_kerja)
            ->addYears($request->lama_kerja)
            ->format('Y-m-d');
    
        // Simpan foto jika ada
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('uploads', 'public');
            $pegawai->foto = $fotoPath;
        }
    
        $pegawai->save();
    
        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil diperbarui.');
    }    
    
    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $jabatans = Jabatan::all(); // Ambil semua data jabatan untuk dropdown
        return view('pages.editpegawai', compact('pegawai', 'jabatans'));
    }

    public function update(Request $request, $id)
{
    $pegawai = Pegawai::findOrFail($id);

    $request->validate([
        'nik' => 'required|unique:pegawais,nik,' . $id,
        'nama' => 'required',
        'tb_jabatan_id' => 'required|exists:tb_jabatan,id',
        'mulai_kerja' => 'required|date',
        'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Menghitung selesai_kerja
    $mulaiKerja = \Carbon\Carbon::parse($request->mulai_kerja); // Parsing tanggal mulai kerja
    $selesaiKerja = $mulaiKerja->addYears($request->lama_kerja); // Menambahkan tahun ke tanggal mulai kerja
    $request->merge(['selesai_kerja' => $selesaiKerja]); // Menambahkan hasil perhitungan ke request

    // Update data pegawai
    $pegawai->update([
        'nik' => $request->nik,
        'nama' => $request->nama,
        'tb_jabatan_id' => $request->tb_jabatan_id,
        'mulai_kerja' => $request->mulai_kerja,
        'selesai_kerja' => $request->selesai_kerja, // Gunakan hasil perhitungan
    ]);

    return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil diperbarui.');
}


    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil dihapus.');
    }

    public function deleteAll()
    {
        Pegawai::truncate(); // Menghapus semua data pegawai
        return redirect()->route('pegawai.index')->with('success', 'Semua data pegawai telah dihapus!');
    }
    

}
