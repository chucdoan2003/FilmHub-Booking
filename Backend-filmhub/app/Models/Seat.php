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
        'row_id',
        'type_id',
        'status',
    ];
    public function rooms() {
        return $this->belongsTo(Room::class, 'room_id');
    }
    public function rows() {
        return $this->belongsTo(Row::class, 'row_id');
    }
    public function types() {
        return $this->belongsTo(Type::class, 'type_id');
    }
}
