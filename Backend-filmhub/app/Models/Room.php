<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['room_name', 'theater_id', 'capacity'];

    protected $primaryKey = 'room_id';
    public function seats() {
        return $this->hasMany(Seat::class, 'room_id');
    }
    public function rows() {
        return $this->hasMany(Row::class, 'room_id');
    }
    public function theaters() {
        return $this->belongsTo(Theater::class, 'theater_id');
    }
}

