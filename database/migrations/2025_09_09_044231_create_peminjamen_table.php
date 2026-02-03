<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();

            // 🔑 kode peminjaman
            $table->string('kode_peminjaman')->unique();

            // relasi ke users & bukus
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('buku_id')->constrained('bukus')->cascadeOnDelete();

            $table->date('tanggal_pinjam');
            $table->date('tenggat_tempo');

            $table->enum('status', [
                'pending',
                'dipinjam',
                'dikembalikan',
                'ditolak',
            ])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};