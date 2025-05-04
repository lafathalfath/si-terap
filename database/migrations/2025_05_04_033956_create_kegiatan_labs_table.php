<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kegiatan_labs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laboratorium_id')->constrained('labs')->onDelete('cascade');
            $table->string('nama_kegiatan');
            $table->text('deskripsi');
            $table->date('tanggal_kegiatan');
            $table->string('penanggung_jawab');
            $table->text('hasil_kegiatan')->nullable();
            $table->string('dokumentasi_path')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kegiatan_labs');
    }
};