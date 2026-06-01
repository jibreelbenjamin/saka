<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SakaAksesMapel extends Model
{
    use HasFactory;

    protected $table = 'saka_akses_mapel';
    protected $primaryKey = 'id_akses_mapel';
    public $timestamps = true;

    protected $fillable = [
        'id_mapel',
        'id_guru',
        'id_kelas',
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

    public function kelas()
    {
        return $this->belongsTo(SakaKelas::class, 'id_kelas', 'id_kelas');
    }
}