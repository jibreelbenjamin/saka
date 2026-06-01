<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('saka_nilai_assesmen', function (Blueprint $table) {
            $table->id('id_nilai_assesmen');
            $table->foreignId('id_komponen_nilai_assesmen')->constrained('saka_komponen_nilai_assesmen', 'id_komponen_nilai_assesmen')->onDelete('cascade');
            $table->foreignId('id_siswa')->constrained('saka_siswa', 'id_siswa')->onDelete('cascade');
            $table->foreignId('id_tahun_ajaran')->constrained('saka_tahun_ajaran', 'id_tahun_ajaran')->onDelete('cascade');
            $table->decimal('nilai', 8, 2);
            $table->decimal('simpanan_nilai_terpakai', 8, 2);
            $table->unique(['id_komponen_nilai_assesmen', 'id_siswa', 'id_tahun_ajaran'], 'nilai_assesmen_unique');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saka_nilai_assesmen');
    }
};