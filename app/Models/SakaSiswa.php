<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class SakaSiswa extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'saka_siswa';
    protected $primaryKey = 'id_siswa';
    public $timestamps = true;

    protected $fillable = [
        'id_kelas',
        'username',
        'password',
        'nama_lengkap',
        'kontak',
        'alamat',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    // Relasi
    public function kelas()
    {
        return $this->belongsTo(SakaKelas::class, 'id_kelas', 'id_kelas');
    }

    public function waliSiswa()
    {
        return $this->hasMany(SakaWaliSiswa::class, 'id_siswa', 'id_siswa');
    }

    public function nilaiHarian()
    {
        return $this->hasMany(SakaNilaiHarian::class, 'id_siswa', 'id_siswa');
    }

    public function nilaiAssesmen()
    {
        return $this->hasMany(SakaNilaiAssesmen::class, 'id_siswa', 'id_siswa');
    }

    public function nilaiAkhir()
    {
        return $this->hasMany(SakaNilaiAkhir::class, 'id_siswa', 'id_siswa');
    }

    public function simpananNilai()
    {
        return $this->hasMany(SakaSimpananNilai::class, 'id_siswa', 'id_siswa');
    }
}