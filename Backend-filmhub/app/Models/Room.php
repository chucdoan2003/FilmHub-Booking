<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $primaryKey = 'room_id';
    protected $fillable = [
        'theater_id',
        'room_name',
        'capacity'
    ];
    public function seats() {
        return $this->hasMany(Seat::class, 'room_id');
    }
    public function theaters() {
        return $this->belongsTo(Theater::class, 'theater_id');
    }
}
