<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('saka_mapel', function (Blueprint $table) {
            $table->id('id_mapel');
            $table->string('nama_mapel', 255);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saka_mapel');
    }
};