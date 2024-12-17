<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $table="vourchers";
    protected $fillable = [
        'voucher_code',
        'voucher_price',
<<<<<<< HEAD
=======
        'required_points',
>>>>>>> c34dbe889404f10f96635ee1e20595a13ffb06b5
        'discount_percentage',
        'max_discount_amount'
    ];
}
