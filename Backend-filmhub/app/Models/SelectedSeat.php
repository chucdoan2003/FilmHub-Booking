<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectedSeat extends Model
{
    use HasFactory;

    // Tên bảng trong cơ sở dữ liệu
    protected $table = 'selected_seats';

    // Các cột được phép gán giá trị hàng loạt (mass assignable)
    protected $fillable = [
        'user_id',
        'showtime_id',
        'seat_id',
        'created_at',
        'updated_at',
    ];

    /**
     * Quan hệ với model `User`
     * Một ghế đã chọn thuộc về một người dùng
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Quan hệ với model `Showtime`
     * Một ghế đã chọn thuộc về một suất chiếu
     */
    public function showtime()
    {
        return $this->belongsTo(Showtime::class);
    }

    /**
     * Quan hệ với model `Seat`
     * Một ghế đã chọn thuộc về một ghế cụ thể
     */
    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }
}
