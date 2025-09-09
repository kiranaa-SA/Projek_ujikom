<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dendas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengembalian_id')->constrained()->cascadeOnDelete();
            $table->enum('kondisi_buku', ['baik', 'rusak', 'hilang']);
            $table->enum('status', ['belum_dibayar', 'lunas'])->default('belum_dibayar');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dendas');
    }
};