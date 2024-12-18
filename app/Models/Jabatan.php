<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'tb_jabatan'; // Nama tabel di database

    protected $fillable = [
        'nama_jabatan', // Sesuaikan dengan kolom pada tabel tb_jabatan
    ];

    /**
     * Relasi ke model Pegawai.
     */
    public function pegawais()
    {
        return $this->hasMany(Pegawai::class, 'tb_jabatan_id');
    }
}
