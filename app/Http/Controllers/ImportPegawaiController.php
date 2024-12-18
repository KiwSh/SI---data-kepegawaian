<?php

namespace App\Http\Controllers;

use App\Imports\PegawaiImport;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use Maatwebsite\Excel\Facades\Excel;

class ImportPegawaiController extends Controller
{
    // Fungsi untuk mengimpor file Excel
    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx'
        ]);

        // Proses impor
        Excel::import(new PegawaiImport, $request->file('excel_file'));

        return redirect()->route('pages.datapegawai')->with('success', 'Data berhasil diimpor!');
    }
}

