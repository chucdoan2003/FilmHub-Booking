<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectedSeat extends Model
{
    use HasFactory;

    protected $table = 'selected_seats';
    protected $primaryKey = 'selected_seat_id';

    protected $fillable = ['seat_id', 'showtime_id' ,'user_id', 'totalPrice', 'created_at', 'updated_at'];

    public function seat()
{
    return $this->belongsTo(Seat::class, 'seat_id');
}

public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
}
