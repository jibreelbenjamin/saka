<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('saka_tahun_ajaran', function (Blueprint $table) {
            $table->id('id_tahun_ajaran');
            $table->integer('tahun_mulai');
            $table->integer('tahun_akhir');
            $table->tinyInteger('semester');
            $table->boolean('is_active')->default(false);
            $table->unique(['tahun_mulai', 'tahun_akhir', 'semester']);
            $table->index('is_active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saka_tahun_ajaran');
    }
};