<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SakaPengaturanNilaiAkhir extends Model
{
    use HasFactory;

    protected $table = 'saka_pengaturan_nilai_akhir';
    protected $primaryKey = 'id_pengaturan_nilai_akhir';
    public $timestamps = true;

    protected $fillable = [
        'id_guru',
        'id_mapel',
        'id_tahun_ajaran',
        'pres_nilai_harian',
        'pres_nilai_assesmen',
        'kkm',
    ];

    protected $casts = [
        'pres_nilai_harian' => 'integer',
        'pres_nilai_assesmen' => 'integer',
        'kkm' => 'integer',
    ];

    // Relasi
    public function guru()
    {
        return $this->belongsTo(SakaGuru::class, 'id_guru', 'id_guru');
    }

    public function mapel()
    {
        return $this->belongsTo(SakaMapel::class, 'id_mapel', 'id_mapel');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(SakaTahunAjaran::class, 'id_tahun_ajaran', 'id_tahun_ajaran');
    }
}