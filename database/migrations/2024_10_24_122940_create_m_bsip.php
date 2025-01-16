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
        Schema::create('m_bsip', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('provinsi_id')->unsigned()->unique();
            $table->string('alamat', 255)->unique();

            $table->timestamps();

            $table->foreign('provinsi_id')->references('id')->on('m_provinsi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_bsip');
    }
};
