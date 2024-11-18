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
    ];
    public $timestamps = false;
    public function showtime()
    {
        return $this->belongsTo(Showtime::class, 'showtime_id');
    }
}
