<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SakaNilaiHarian extends Model
{
    use HasFactory;

    protected $table = 'saka_nilai_harian';
    protected $primaryKey = 'id_nilai_harian';
    public $timestamps = true;

    protected $fillable = [
        'id_komponen_nilai_harian',
        'id_siswa',
        'nilai',
        'simpanan_nilai_terpakai',
    ];

    protected $casts = [
        'nilai' => 'decimal:2',
        'simpanan_nilai_terpakai' => 'decimal:2',
    ];

    // Relasi
    public function komponenNilaiHarian()
    {
        return $this->belongsTo(SakaKomponenNilaiHarian::class, 'id_komponen_nilai_harian', 'id_komponen_nilai_harian');
    }

    public function siswa()
    {
        return $this->belongsTo(SakaSiswa::class, 'id_siswa', 'id_siswa');
    }
}