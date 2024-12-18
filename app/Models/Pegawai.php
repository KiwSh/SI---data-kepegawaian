<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawais';

    protected $fillable = [
        'nik', 'nama', 'tanggal_lahir', 'alamat',
        'tb_jabatan_id', 'mulai_kerja', 'lama_kerja',
        'selesai_kerja', 'foto',
    ];



    /**
     * Relasi ke model Jabatan (tb_jabatan).
     */
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'tb_jabatan_id', 'id');
    }
    
}
