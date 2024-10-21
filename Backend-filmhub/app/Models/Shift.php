<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = ['shift_name', 'start_time', 'end_time'];

    protected $primaryKey = 'shift_id';
    public function theater()
    {
        return $this->belongsTo(Theater::class, 'theater_id');
    }
}

