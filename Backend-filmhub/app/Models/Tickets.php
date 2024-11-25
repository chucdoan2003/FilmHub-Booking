<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    protected $fillable = [
        'user_id',
        'showtime_id',
        'total_price',
        'ticket_time',
        'status',
    ];
}
