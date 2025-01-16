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
        Schema::create('pemanfaatan_sip', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ip2sip_id')->unique();
            $table->unsignedDouble('luas_sip');
            $table->unsignedInteger('jumlah_sdm');
            $table->string('agro_ekosistem');
            $table->timestamps();
            
            $table->foreign('ip2sip_id')->references('id')->on('m_ip2sip');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemanfaatan_sip');
    }
};
