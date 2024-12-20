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
        Schema::create('showtimes', function (Blueprint $table) {
            $table->id('showtime_id');
            $table->unsignedBigInteger('movie_id');
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('shift_id');
            $table->unsignedBigInteger('theater_id')->nullable();
            $table->date('datetime')->nullable();
            $table->integer('value')->nullable();
            $table->integer('normal_price')->nullable();
            $table->integer('vip_price')->nullable();

            $table->timestamps();

            // Indexes
            $table->foreign('movie_id')->references('movie_id')->on('movies')->onDelete('cascade');
            $table->foreign('room_id')->references('room_id')->on('rooms')->onDelete('cascade');
            $table->foreign('shift_id')->references('shift_id')->on('shifts')->onDelete('cascade');
            $table->foreign('theater_id')->references('theater_id')->on('theaters')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
