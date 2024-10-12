<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;
    protected $primaryKey = 'seat_id';
    protected $fillable = [
        'room_id',
        'seat_number',
        'seat_type',
        'status',
    ];
}
