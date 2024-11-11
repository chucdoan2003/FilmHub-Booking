<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;


    protected $fillable = ['room_name', 'theater_id', 'capacity'];

    protected $primaryKey = 'room_id';

    public function theater()
    {
        return $this->belongsTo(Theater::class, 'theater_id');
    }

    public function seats()
    {

        return $this->hasMany(Seat::class, 'room_id');

        return $this->hasMany(Seat::class);
    }
}
