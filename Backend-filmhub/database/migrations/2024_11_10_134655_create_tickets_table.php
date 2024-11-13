<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id('ticket_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('showtime_id');
            $table->decimal('total_price', 10, 2);
            $table->timestamp('ticket_time')->default(DB::raw('CURRENT_TIMESTAMP'));

            // Indexes
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('showtime_id')->references('showtime_id')->on('showtimes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};