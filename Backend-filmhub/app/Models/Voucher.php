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
        'discount_percentage',
        'max_discount_amount'
    ];
}
