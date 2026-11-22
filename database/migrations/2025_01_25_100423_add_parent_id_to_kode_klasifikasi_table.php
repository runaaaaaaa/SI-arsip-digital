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
        Schema::table('tb_kode_klasifikasi', function (Blueprint $table) {
            $table->unsignedBigInteger('id_parent_klasifikasi')->nullable()->after('id_kode_klasifikasi');
            $table->foreign('id_parent_klasifikasi')->references('id_kode_klasifikasi')->on('tb_kode_klasifikasi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_kode_klasifikasi', function (Blueprint $table) {
            $table->dropForeign(['id_parent_klasifikasi']);
            $table->dropColumn('id_parent_klasifikasi');
        });
    }
};
