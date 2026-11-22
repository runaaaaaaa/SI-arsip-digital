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
        Schema::create('tb_lampiran', function (Blueprint $table) {
            $table->id('id_lampiran');
            $table->foreignId('id_arsip')->constrained('tb_arsip', 'id_arsip')->onDelete('cascade');
            $table->string('nama_file');
            $table->string('url_file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_lampiran');
    }
};
