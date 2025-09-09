<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('raks', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 50);
            $table->string('nama', 100);
            $table->string('lokasi', 100); // contoh: Lantai 1 - Kiri
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('raks');
    }
};