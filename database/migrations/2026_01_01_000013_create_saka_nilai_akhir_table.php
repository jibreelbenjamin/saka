<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('saka_nilai_akhir', function (Blueprint $table) {
            $table->id('id_nilai_akhir');
            $table->foreignId('id_mapel')->constrained('saka_mapel', 'id_mapel')->onDelete('cascade');
            $table->foreignId('id_siswa')->constrained('saka_siswa', 'id_siswa')->onDelete('cascade');
            $table->decimal('nilai', 8, 2);
            $table->unique(['id_mapel', 'id_siswa'], 'nilai_akhir_unique');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saka_nilai_akhir');
    }
};