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
        Schema::create('seats', function (Blueprint $table) {
            $table->id('seat_id');
            $table->unsignedBigInteger('room_id');
            $table->string('seat_number', 10);
            $table->enum('status', ['normal', 'vip'])->default('normal');
            $table->timestamps();
            $table->unsignedBigInteger('row_id');
            $table->unsignedBigInteger('type_id');

            // Indexes
            $table->foreign('room_id')->references('room_id')->on('rooms')->onDelete('cascade');
            $table->foreign('row_id')->references('row_id')->on('rows')->onDelete('cascade');
            $table->foreign('type_id')->references('type_id')->on('types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seats');
    }
};
