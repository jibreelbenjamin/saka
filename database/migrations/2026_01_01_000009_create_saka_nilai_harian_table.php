<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('saka_nilai_harian', function (Blueprint $table) {
            $table->id('id_nilai_harian');
            $table->foreignId('id_komponen_nilai_harian')->constrained('saka_komponen_nilai_harian', 'id_komponen_nilai_harian')->onDelete('cascade');
            $table->foreignId('id_siswa')->constrained('saka_siswa', 'id_siswa')->onDelete('cascade');
            $table->decimal('nilai', 8, 2);
            $table->unique(['id_komponen_nilai_harian', 'id_siswa'], 'nilai_harian_unique');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saka_nilai_harian');
    }
};