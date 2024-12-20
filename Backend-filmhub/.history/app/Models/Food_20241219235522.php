<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $table = 'foods';
    protected $fillable = ['name', 'price'];

    public function combos()
    {
        return $this->belongsToMany(Combo::class, 'combo_food_drink');
    }
    // Trong Food.php
public function tickets()
{
    return $this->hasMany(Ticket::class, 'food_id');
}

}
