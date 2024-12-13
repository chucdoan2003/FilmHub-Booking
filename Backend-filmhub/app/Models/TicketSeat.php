<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketSeat extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tickets_seats';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = ['ticket_id', 'seat_id'];

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ticket_id',
        'seat_id',
        'showtime_id',
    ];

    /**
     * Get the ticket that owns the ticket seat.
     */
    public function ticket()
{
    return $this->belongsTo(Ticket::class, 'ticket_id'); // ticket_id là cột trong bảng tickets_seats
}

    /**
     * Get the seat associated with the ticket seat.
     */
    public function seat()
    {
        return $this->belongsTo(Seat::class, 'seat_id'); // seat_id là cột trong bảng tickets_seats liên kết với bảng seats
    }

    /**
     * Get the showtime associated with the ticket seat.
     */
    public function showtime()
    {
        return $this->belongsTo(Showtime::class, 'showtime_id', 'showtime_id');
    }
}
