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
        Schema::create('tb_arsip', function (Blueprint $table) {
            $table->id('id_arsip');
            $table->string('nomor_arsip')->unique();
            $table->foreignId('id_user_pemilik')->constrained('tb_user', 'id_user')->onDelete('cascade');
            $table->foreignId('id_rak')->constrained('tb_rak', 'id_rak')->onDelete('cascade');
            $table->foreignId('id_kategori')->constrained('tb_kategori_arsip', 'id_kategori')->onDelete('cascade');
            $table->foreignId('id_kode_klasifikasi')->constrained('tb_kode_klasifikasi', 'id_kode_klasifikasi')->onDelete('cascade');
            $table->enum('jenis_arsip', ['segera', 'rahasia', 'penting', 'biasa']);
            $table->enum('kategori_sifat', ['masuk', 'keluar']);
            $table->date('tanggal_surat');
            $table->string('pengirim');
            $table->string('penerima');
            $table->string('perihal');
            $table->enum('status_arsip', ['aktif', 'inaktif', 'dipindahkan'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_arsip');
    }
};
