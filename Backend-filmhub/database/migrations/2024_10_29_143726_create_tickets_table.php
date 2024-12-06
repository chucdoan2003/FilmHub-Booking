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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id('ticket_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('showtime_id');
            $table->decimal('total_price', 10, 2);
            $table->timestamp('ticket_time')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('status', 255)->default('pending')->collation('utf8mb4_unicode_ci');
            $table->unsignedBigInteger('food_id')->nullable();
            $table->unsignedBigInteger('drink_id')->nullable();
            $table->unsignedBigInteger('combo_id')->nullable();
            $table->string('qr_code')->nullable(); // Lưu đường dẫn QR code
            // Indexes

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('showtime_id')->references('showtime_id')->on('showtimes')->onDelete('cascade');
            $table->foreign('food_id')->references('id')->on('foods')->onDelete('set null');
            $table->foreign('drink_id')->references('id')->on('drinks')->onDelete('set null');
            $table->foreign('combo_id')->references('id')->on('combos')->onDelete('set null');
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
