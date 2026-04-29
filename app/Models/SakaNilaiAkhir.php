<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SakaNilaiAkhir extends Model
{
    use HasFactory;

    protected $table = 'saka_nilai_akhir';
    protected $primaryKey = 'id_nilai_akhir';
    public $timestamps = true;

    protected $fillable = [
        'id_mapel',
        'id_siswa',
        'nilai',
    ];

    protected $casts = [
        'nilai' => 'decimal:2',
    ];

    // Relasi
    public function mapel()
    {
        return $this->belongsTo(SakaMapel::class, 'id_mapel', 'id_mapel');
    }

    public function siswa()
    {
        return $this->belongsTo(SakaSiswa::class, 'id_siswa', 'id_siswa');
    }
}