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
        Schema::create('m_provinsi', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->double('longitude');
            $table->double('latitude');
            $table->integer('jumlah_dokumen')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_provinsi');
    }
};
