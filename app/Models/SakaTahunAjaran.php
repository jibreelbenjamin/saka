<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SakaTahunAjaran extends Model
{
    use HasFactory;

    protected $table = 'saka_tahun_ajaran';
    protected $primaryKey = 'id_tahun_ajaran';
    public $timestamps = true;

    protected $fillable = [
        'tahun_mulai',
        'tahun_akhir',
        'semester',
        'is_active',
    ];

    protected $casts = [
        'tahun_mulai' => 'integer',
        'tahun_akhir' => 'integer',
        'semester' => 'integer',
        'is_active' => 'boolean',
    ];

    // Relasi
    public function komponenNilaiHarian()
    {
        return $this->hasMany(SakaKomponenNilaiHarian::class, 'id_tahun_ajaran', 'id_tahun_ajaran');
    }

    public function komponenNilaiAssesmen()
    {
        return $this->hasMany(SakaKomponenNilaiAssesmen::class, 'id_tahun_ajaran', 'id_tahun_ajaran');
    }

    public function nilaiHarian()
    {
        return $this->hasMany(SakaNilaiHarian::class, 'id_tahun_ajaran', 'id_tahun_ajaran');
    }

    public function nilaiAssesmen()
    {
        return $this->hasMany(SakaNilaiAssesmen::class, 'id_tahun_ajaran', 'id_tahun_ajaran');
    }

    public function pengaturanNilaiAkhir()
    {
        return $this->hasMany(SakaPengaturanNilaiAkhir::class, 'id_tahun_ajaran', 'id_tahun_ajaran');
    }

    public function nilaiAkhir()
    {
        return $this->hasMany(SakaNilaiAkhir::class, 'id_tahun_ajaran', 'id_tahun_ajaran');
    }

    public function simpananNilai()
    {
        return $this->hasMany(SakaSimpananNilai::class, 'id_tahun_ajaran', 'id_tahun_ajaran');
    }
}
