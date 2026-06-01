<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SakaKomponenNilaiAssesmen extends Model
{
    use HasFactory;

    protected $table = 'saka_komponen_nilai_assesmen';
    protected $primaryKey = 'id_komponen_nilai_assesmen';
    public $timestamps = true;

    protected $fillable = [
        'kode_komponen_assesmen',
        'id_mapel',
        'id_guru',
        'id_tahun_ajaran',
        'nama_komponen',
        'kkm',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'kkm' => 'integer',
    ];

    // Relasi
    public function mapel()
    {
        return $this->belongsTo(SakaMapel::class, 'id_mapel', 'id_mapel');
    }

    public function guru()
    {
        return $this->belongsTo(SakaGuru::class, 'id_guru', 'id_guru');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(SakaTahunAjaran::class, 'id_tahun_ajaran', 'id_tahun_ajaran');
    }

    public function nilaiAssesmen()
    {
        return $this->hasMany(SakaNilaiAssesmen::class, 'id_komponen_nilai_assesmen', 'id_komponen_nilai_assesmen');
    }
}