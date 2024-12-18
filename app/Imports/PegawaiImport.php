<?php

namespace App\Imports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\ToModel;

class PegawaiImport implements ToModel
{
    public function model(array $row)
    {
        return new Pegawai([
            'nik' => $row[0],
            'nama' => $row[1],
            'jabatan' => $row[2],
            'mulai_kerja' => $row[3],
            // Menambahkan kolom foto jika ada
            'foto' => isset($row[4]) ? $row[4] : null,  // Jika kolom foto ada
        ]);
    }
}

