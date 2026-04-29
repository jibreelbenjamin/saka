<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SakaKelas extends Model
{
    use HasFactory;

    protected $table = 'saka_kelas';
    protected $primaryKey = 'id_kelas';
    public $timestamps = true;

    protected $fillable = [
        'nama_kelas',
        'tingkat',
    ];

    protected $casts = [
        'tingkat' => 'string',
    ];

    // Relasi
    public function siswas()
    {
        return $this->hasMany(SakaSiswa::class, 'id_kelas', 'id_kelas');
    }
}