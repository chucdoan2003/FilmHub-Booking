<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Showtime extends Model
{
    use HasFactory;
    protected $table = 'showtimes';
    protected $primaryKey = 'showtime_id';
    public $incrementing = false; // Nếu 'showtime_id' không tự động tăng

    protected $fillable = [
        'movie_id',
        'room_id',
        'shift_id',
        'start_time',
        'end_time',
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class, 'movie_id', 'movie_id'); // Thay đổi nếu cần
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'room_id'); // Thay đổi nếu cần
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id', 'shift_id'); // Thay đổi nếu cần
    }
}
