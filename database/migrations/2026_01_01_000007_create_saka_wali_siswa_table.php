<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('saka_wali_siswa', function (Blueprint $table) {
            $table->id('id_wali_siswa');
            $table->foreignId('id_siswa')->constrained('saka_siswa', 'id_siswa')->onDelete('cascade');
            $table->string('nama_wali', 255);
            $table->string('kontak', 255)->nullable();
            $table->string('alamat', 255)->nullable();
            $table->string('status_wali', 255)->nullable()->comment('Orang tua, Orang tua angkat, kakak, perwakilan, dll....');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saka_wali_siswa');
    }
};