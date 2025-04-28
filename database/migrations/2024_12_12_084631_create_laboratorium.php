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
            $table->string('longitude');
            $table->string('latitude');
            $table->text('jenis_analisis');
            $table->text('metode_analisis');
            $table->text('analisis');
            $table->text('kompetensi_personal');
            $table->text('nama_pelatihan');
            $table->year('tahun');
            $table->string('masa_berlaku');
            $table->string('no_akreditasi');
            $table->integer('jumlah_gedung');
            $table->enum('gedung_memadai', ['Ya', 'Tidak']);
            $table->text('jenis_peralatan');
            $table->string('foto_lab');
            $table->text('alamat_lab');
            $table->string('telepon_lab');
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
