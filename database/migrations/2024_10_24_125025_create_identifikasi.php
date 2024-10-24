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
        Schema::create('identifikasi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bsip_id')->unsigned(); //
            $table->date('tanggal');
            $table->bigInteger('metode_id')->unsigned(); //
            $table->enum('jenis_usulan', ['revisi', 'baru']);
            $table->bigInteger('created_by')->unsigned(); //
            $table->bigInteger('updated_by')->unsigned(); //
            $table->timestamps();

            $table->foreign('bsip_id')->references('id')->on('m_bsip');
            $table->foreign('metode_id')->references('id')->on('m_metode');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identifikasi');
    }
};