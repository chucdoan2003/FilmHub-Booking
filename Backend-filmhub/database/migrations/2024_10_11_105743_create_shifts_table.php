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
        Schema::create('shifts', function (Blueprint $table) {
            $table->id('shift_id');
            $table->string('shift_name');
            $table->time('start_time');
            $table->time('end_time');
            $table->unsignedBigInteger('theater_id')->nullable();
            $table->unsignedBigInteger('room_id')->nullable();
            $table->timestamps();

            // Indexes
            $table->foreign('theater_id')->references('theater_id')->on('theaters')->onDelete('cascade');
            $table->foreign('room_id')->references('room_id')->on('rooms')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};
