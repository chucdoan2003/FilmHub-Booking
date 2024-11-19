<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('combo_food_drink', function (Blueprint $table) {
            $table->id();
            $table->foreignId('combo_id')->constrained()->onDelete('cascade'); // Khóa ngoại tới combos
            $table->foreignId('food_id')->nullable()->constrained('foods')->onDelete('cascade'); // Khóa ngoại tới foods
            $table->foreignId('drink_id')->nullable()->constrained('drinks')->onDelete('cascade'); // Khóa ngoại tới drinks
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('combo_food_drink');
    }
};
