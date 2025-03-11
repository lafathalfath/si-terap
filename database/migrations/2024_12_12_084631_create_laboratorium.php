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
        Schema::create('laboratorium', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bsip_id');
            $table->unsignedBigInteger('jenis_lab_id');
            $table->string('langitude');
            $table->string('latitude');
            $table->string('jenis_analisis');
            $table->text('metode_analisis');
            $table->text('analisis');
            $table->text('kompetensi_personal');
            $table->string('nama_pelatihan');
            $table->year('tahun');
            $table->timestamps();

            $table->foreign('bsip_id')->references('id')->on('m_bsip');
            $table->foreign('jenis_lab_id')->references('id')->on('m_jenis_lab');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratorium');
    }
};
