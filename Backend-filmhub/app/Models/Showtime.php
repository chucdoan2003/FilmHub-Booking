<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Showtime extends Model
{
    use HasFactory;


    protected $table = 'showtimes';
    protected $primaryKey = 'showtime_id';

    protected $fillable = [
        'movie_id',
        'room_id',
        'shift_id',
        'start_time',
        'end_time',
    ];


    public function movies()
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }

    public function rooms()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function shifts()
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }


    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'showtime_id');
    }


    public function movie()
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }

    public function theater()
    {
        return $this->belongsTo(Theater::class, 'theater_id');
    }

}


