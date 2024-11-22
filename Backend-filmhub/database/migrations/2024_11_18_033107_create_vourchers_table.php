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
        Schema::create('vourchers', function (Blueprint $table) {
            $table->id();
            $table->string('voucher_code');
            $table->float('voucher_price');
            $table->date('start_time');
            $table->date('end_time');
            $table->integer('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vourchers');
    }
};
