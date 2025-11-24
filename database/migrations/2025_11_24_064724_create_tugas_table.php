<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tugas', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('nama_matakuliah');
            $table->string('tugas');
            $table->text('deskripsi')->nullable();
            $table->enum('jenis', ['Praktikum', 'Teori', 'Tugas', 'Quiz', 'UTS', 'UAS']);
            $table->date('deadline');
            $table->enum('status', ['Belum Mulai', 'Berlangsung', 'Selesai'])->default('Belum Mulai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas');
    }
};