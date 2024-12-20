<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    use HasFactory;
    protected $table = 'drinks';
    protected $fillable = ['name', 'price'];

    public function combos()
    {
        return $this->belongsToMany(Combo::class, 'combo_food_drink');
    }
    // Trong Drink.php
public function tickets()
{
    return $this->hasMany(Ticket::class, 'drink_id');
}
}
