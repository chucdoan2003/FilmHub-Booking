<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = ['room_id', 'seat_number', 'status'];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
