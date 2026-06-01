<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('saka_pengaturan_nilai_akhir', function (Blueprint $table) {
            $table->id('id_pengaturan_nilai_akhir');
            $table->foreignId('id_guru')->constrained('saka_guru', 'id_guru')->onDelete('cascade');
            $table->foreignId('id_mapel')->constrained('saka_mapel', 'id_mapel')->onDelete('cascade');
            $table->foreignId('id_tahun_ajaran')->constrained('saka_tahun_ajaran', 'id_tahun_ajaran')->onDelete('cascade');
            $table->integer('pres_nilai_harian')->default(60);
            $table->integer('pres_nilai_assesmen')->default(40);
            $table->integer('kkm')->default(75);
            $table->unique(['id_guru', 'id_mapel', 'id_tahun_ajaran'], 'pengaturan_nilai_akhir_unique');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saka_pengaturan_nilai_akhir');
    }
};