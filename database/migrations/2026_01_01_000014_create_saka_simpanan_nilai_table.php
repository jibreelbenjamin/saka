<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('saka_simpanan_nilai', function (Blueprint $table) {
            $table->id('id_simpanan_nilai');
            $table->foreignId('id_mapel')->constrained('saka_mapel', 'id_mapel')->onDelete('cascade');
            $table->foreignId('id_guru')->constrained('saka_guru', 'id_guru')->onDelete('cascade');
            $table->foreignId('id_siswa')->constrained('saka_siswa', 'id_siswa')->onDelete('cascade');
            $table->decimal('nilai', 8, 2);
            $table->decimal('terpakai_harian', 8, 2);
            $table->decimal('terpakai_assesmen', 8, 2);
            $table->decimal('max_pemakaian', 8, 2)->default(100);
            $table->decimal('nilai_prioritas', 8, 2)->default(75);
            $table->unique(['id_mapel', 'id_guru', 'id_siswa'], 'simpanan_nilai_unique');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saka_simpanan_nilai');
    }
};