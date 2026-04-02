<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengembalians', function (Blueprint $table) {
            $table->string('kode_pengembalian')->after('peminjaman_id')->nullable()->unique();
        });
    }

    public function down(): void
    {
        Schema::table('pengembalians', function (Blueprint $table) {
            $table->dropColumn('kode_pengembalian');
        });
    }
};