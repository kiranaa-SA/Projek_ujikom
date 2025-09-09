<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengembalians', function (Blueprint $table) {
            $table->id();

            // relasi ke peminjaman
            $table->foreignId('peminjaman_id')
                ->constrained('peminjamans')
                ->cascadeOnDelete();

            $table->date('tanggal_pengembalian');
            $table->integer('terlambat')->default(0); // jumlah hari terlambat
            $table->enum('kondisi', ['baik', 'rusak', 'hilang'])->default('baik');
            $table->integer('denda')->default(0); // denda otomatis

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengembalians');
    }
};