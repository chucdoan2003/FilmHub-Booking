<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vourcher extends Model
{
    use HasFactory;
    protected $table="vourchers";
    protected $fillable = [
        'voucher_code',
        'voucher_price'
    ];

}
