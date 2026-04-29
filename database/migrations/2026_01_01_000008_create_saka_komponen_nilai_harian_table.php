<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('saka_komponen_nilai_harian', function (Blueprint $table) {
            $table->id('id_komponen_nilai_harian');
            $table->string('kode_komponen_harian', 255)->unique();
            $table->foreignId('id_mapel')->constrained('saka_mapel', 'id_mapel')->onDelete('cascade');
            $table->foreignId('id_guru')->constrained('saka_guru', 'id_guru')->onDelete('cascade');
            $table->string('nama_komponen', 255);
            $table->integer('kkm')->default(75);
            $table->tinyInteger('is_active')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saka_komponen_nilai_harian');
    }
};