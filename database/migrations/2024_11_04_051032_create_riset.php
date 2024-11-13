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
        Schema::create('riset', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kecamatan_id')->unsigned();
            $table->string('judul')->unique();
            $table->timestamps();

            $table->foreign('kecamatan_id')->references('id')->on('m_kecamatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riset');
    }
};