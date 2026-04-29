<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SakaWaliSiswa extends Model
{
    use HasFactory;

    protected $table = 'saka_wali_siswa';
    protected $primaryKey = 'id_wali_siswa';
    public $timestamps = true;

    protected $fillable = [
        'id_siswa',
        'nama_wali',
        'kontak',
        'alamat',
        'status_wali',
    ];

    // Relasi
    public function siswa()
    {
        return $this->belongsTo(SakaSiswa::class, 'id_siswa', 'id_siswa');
    }
}