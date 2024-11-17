<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComboFoodDrink extends Model
{
    use HasFactory;
    protected $table = 'combo_food_drink'; // Tên bảng trung gian

    protected $fillable = [
        'combo_id',
        'food_id',
        'drink_id',
    ];
    public function combos()
    {
        return $this->belongsToMany(Combo::class, 'drinks_id', 'foods_id');
    }

    // Quan hệ với Food
    public function foods()
    {
        return $this->belongsTo(Food::class);
    }

    // Quan hệ với Drink
    public function drinks()
    {
        return $this->belongsTo(Drink::class);
    }
}
