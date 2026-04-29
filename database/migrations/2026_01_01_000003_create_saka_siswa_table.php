<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('saka_siswa', function (Blueprint $table) {
            $table->id('id_siswa');
            $table->foreignId('id_kelas')->constrained('saka_kelas', 'id_kelas')->onDelete('cascade');
            $table->string('username', 255)->unique();
            $table->string('password', 255);
            $table->string('nama_lengkap', 255);
            $table->string('kontak', 255)->nullable();
            $table->string('alamat', 255)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saka_siswa');
    }
};