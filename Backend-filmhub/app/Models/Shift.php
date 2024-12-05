<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = ['shift_name', 'start_time', 'end_time'];

    protected $table = 'shifts';
    protected $primaryKey = 'shift_id';
    public function theater()
    {
        return $this->belongsTo(Theater::class, 'theater_id');
    }
    public function showtimes()
    {
        return $this->hasMany(Showtime::class, 'shift_id');
    }

    // Quan hệ gián tiếp với tickets qua showtimes
    public function tickets()
    {
        return $this->hasManyThrough(Ticket::class, Showtime::class, 'shift_id', 'showtime_id');
    }
}
