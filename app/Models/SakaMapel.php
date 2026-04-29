<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SakaMapel extends Model
{
    use HasFactory;

    protected $table = 'saka_mapel';
    protected $primaryKey = 'id_mapel';
    public $timestamps = true;

    protected $fillable = [
        'nama_mapel',
    ];

    // Relasi
    public function aksesMapel()
    {
        return $this->hasMany(SakaAksesMapel::class, 'id_mapel', 'id_mapel');
    }

    public function gurus()
    {
        return $this->belongsToMany(SakaGuru::class, 'saka_akses_mapel', 'id_mapel', 'id_guru');
    }

    public function komponenNilaiHarian()
    {
        return $this->hasMany(SakaKomponenNilaiHarian::class, 'id_mapel', 'id_mapel');
    }

    public function komponenNilaiAssesmen()
    {
        return $this->hasMany(SakaKomponenNilaiAssesmen::class, 'id_mapel', 'id_mapel');
    }

    public function pengaturanNilaiAkhir()
    {
        return $this->hasMany(SakaPengaturanNilaiAkhir::class, 'id_mapel', 'id_mapel');
    }

    public function nilaiAkhir()
    {
        return $this->hasMany(SakaNilaiAkhir::class, 'id_mapel', 'id_mapel');
    }

    public function simpananNilai()
    {
        return $this->hasMany(SakaSimpananNilai::class, 'id_mapel', 'id_mapel');
    }
}