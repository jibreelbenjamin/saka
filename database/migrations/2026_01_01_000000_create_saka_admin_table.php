<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('saka_admin', function (Blueprint $table) {
            $table->id('id_admin');
            $table->string('username', 255)->unique();
            $table->string('password', 255);
            $table->string('nama_admin', 255);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saka_admin');
    }
};