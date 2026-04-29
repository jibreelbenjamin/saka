<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('saka_kelas', function (Blueprint $table) {
            $table->id('id_kelas');
            $table->string('nama_kelas', 255);
            $table->enum('tingkat', ['1', '2', '3'])->default('1');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saka_kelas');
    }
};