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
        Schema::table('seats', function (Blueprint $table) {
            $table->enum('seat_type', ['standard', 'vip'])->after('status')->nullable();
            $table->timestamp('updated_at')->nullable(); // Thêm cột updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seats', function (Blueprint $table) {
            // Xóa cột seat_type và updated_at nếu migration bị rollback
            $table->dropColumn('seat_type');
            $table->dropColumn('updated_at');
        });
    }
};
