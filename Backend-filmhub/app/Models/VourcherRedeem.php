<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VourcherRedeem extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table="vourchers_redeem";
    protected $fillable = [
        'id',
        'voucher_id',
        'user_id',
        'vourcher_code',
        'vourcher_name',
        'discount_percentage',
        'max_discount_amount',
        'is_active'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id'); // Liên kết tới bảng users
    }
    
}
