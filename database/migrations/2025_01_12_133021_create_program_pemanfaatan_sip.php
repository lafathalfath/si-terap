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
        Schema::create('program_pemanfaatan_sip', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('detail_pemanfaatan_sip_id');
            $table->string('program');
            $table->timestamps();

            $table->foreign('detail_pemanfaatan_sip_id')->references('id')->on('detail_pemanfaatan_sip')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_pemanfaatan_sip');
    }
};
