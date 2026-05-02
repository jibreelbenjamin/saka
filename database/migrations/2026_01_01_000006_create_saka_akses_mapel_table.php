<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('saka_akses_mapel', function (Blueprint $table) {
            $table->id('id_akses_mapel');
            $table->foreignId('id_mapel')->constrained('saka_mapel', 'id_mapel')->onDelete('cascade');
            $table->foreignId('id_guru')->constrained('saka_guru', 'id_guru')->onDelete('cascade');
            $table->foreignId('id_kelas')->constrained('saka_kelas', 'id_kelas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saka_akses_mapel');
    }
};