<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Row extends Model
{
    use HasFactory;
    protected $primaryKey = 'row_id';
    protected $fillable = [
        'row_name',
        'room_id'
    ];
    public function seats() {
        return $this->hasMany(Seat::class, 'row_id');
    }
    public function rooms() {
        return $this->belongsTo(Room::class, 'room_id'); 
    }
}
