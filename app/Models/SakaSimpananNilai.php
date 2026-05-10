<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SakaSimpananNilai extends Model
{
    use HasFactory;

    protected $table = 'saka_simpanan_nilai';
    protected $primaryKey = 'id_simpanan_nilai';
    public $timestamps = true;

    protected $fillable = [
        'id_mapel',
        'id_guru',
        'id_siswa',
        'nilai',
        'terpakai_harian',
        'terpakai_assesmen',
    ];

    protected $casts = [
        'nilai' => 'decimal:2',
        'terpakai_harian' => 'decimal:2',
        'terpakai_assesmen' => 'decimal:2',
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

    public function siswa()
    {
        return $this->belongsTo(SakaSiswa::class, 'id_siswa', 'id_siswa');
    }
}