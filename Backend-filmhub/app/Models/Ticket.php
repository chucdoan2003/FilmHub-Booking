<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $primaryKey = 'ticket_id';
    protected $fillable = [
        'user_id',
        'showtime_id',
        'total_price',
        'ticket_time',
        'status',
        'food_id', 'drink_id', 'combo_id',
    ];
    public $timestamps = false;
    public function showtime()
    {
        return $this->belongsTo(Showtime::class, 'showtime_id');
    }

    public function food()
    {
        return $this->belongsTo(Food::class, 'food_id');
    }


    public function drink()
    {
        return $this->belongsTo(Drink::class, 'drink_id');
    }


    public function combo()
    {
        return $this->belongsTo(Combo::class, 'combo_id');
    }

    public function ticketsSeats()
{
    return $this->hasMany(TicketSeat::class, 'ticket_id');
}
}
