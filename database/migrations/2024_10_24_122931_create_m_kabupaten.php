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
        Schema::create('m_kabupaten', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('provinsi_id')->unsigned();
            $table->string('name');
            $table->timestamps();

            $table->foreign('provinsi_id')->references('id')->on('m_provinsi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_kabupaten');
    }
};
