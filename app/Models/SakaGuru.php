<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class SakaGuru extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'saka_guru';
    protected $primaryKey = 'id_guru';
    public $timestamps = true;

    protected $fillable = [
        'username',
        'password',
        'nama',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    // Relasi
    public function aksesMapel()
    {
        return $this->hasMany(SakaAksesMapel::class, 'id_guru', 'id_guru');
    }

    public function mapels()
    {
        return $this->belongsToMany(SakaMapel::class, 'saka_akses_mapel', 'id_guru', 'id_mapel');
    }

    public function komponenNilaiHarian()
    {
        return $this->hasMany(SakaKomponenNilaiHarian::class, 'id_guru', 'id_guru');
    }

    public function komponenNilaiAssesmen()
    {
        return $this->hasMany(SakaKomponenNilaiAssesmen::class, 'id_guru', 'id_guru');
    }

    public function pengaturanNilaiAkhir()
    {
        return $this->hasMany(SakaPengaturanNilaiAkhir::class, 'id_guru', 'id_guru');
    }

    public function simpananNilai()
    {
        return $this->hasMany(SakaSimpananNilai::class, 'id_guru', 'id_guru');
    }
}