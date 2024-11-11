<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Row extends Model
{
    use HasFactory;
    protected $primaryKey = 'row_id';
    protected $fillable = [
        'row_name'
    ];
    public function seats() {
        return $this->hasMany(Seat::class);
    }
}
