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
        Schema::create('tickets_seats', function (Blueprint $table) {
            $table->unsignedBigInteger('ticket_id');
            $table->unsignedBigInteger('seat_id');
            $table->unsignedBigInteger('showtime_id');
            // Indexes
            $table->primary(['ticket_id', 'seat_id']);
            $table->foreign('ticket_id')->references('ticket_id')->on('tickets')->onDelete('cascade');
            $table->foreign('seat_id')->references('seat_id')->on('seats')->onDelete('cascade');
            $table->foreign('showtime_id')->references('showtime_id')->on('showtimes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets_seats');
    }
};
