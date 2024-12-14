<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{
    use HasFactory;
    // protected $table = 'combos';
    protected $fillable = ['name', 'price'];

    public function foods()
    {
        return $this->belongsToMany(Food::class, 'combo_food_drink');
    }

    public function drinks()
    {
        return $this->belongsToMany(Drink::class, 'combo_food_drink');
    }
    public function calculateTotalPrice()
    {
        $foodPrice = $this->foods()->sum('price');
        $drinkPrice = $this->drinks()->sum('price');
        return $foodPrice + $drinkPrice;
    }
    public function comboFoodDrink()
    {
        return $this->hasMany(ComboFoodDrink::class);
    }
}
