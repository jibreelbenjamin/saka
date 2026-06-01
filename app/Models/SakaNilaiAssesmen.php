<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SakaNilaiAssesmen extends Model
{
    use HasFactory;

    protected $table = 'saka_nilai_assesmen';
    protected $primaryKey = 'id_nilai_assesmen';
    public $timestamps = true;

    protected $fillable = [
        'id_komponen_nilai_assesmen',
        'id_siswa',
        'id_tahun_ajaran',
        'nilai',
        'simpanan_nilai_terpakai',
    ];

    protected $casts = [
        'nilai' => 'decimal:2',
        'simpanan_nilai_terpakai' => 'decimal:2',
    ];

    // Relasi
    public function komponenNilaiAssesmen()
    {
        return $this->belongsTo(SakaKomponenNilaiAssesmen::class, 'id_komponen_nilai_assesmen', 'id_komponen_nilai_assesmen');
    }

    public function siswa()
    {
        return $this->belongsTo(SakaSiswa::class, 'id_siswa', 'id_siswa');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(SakaTahunAjaran::class, 'id_tahun_ajaran', 'id_tahun_ajaran');
    }
}