<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;
    protected $table = 'shifts'; // Tên bảng
    protected $primaryKey = 'shift_id'; // Khóa chính
    public $incrementing = false; // Nếu shift_id không tự động tăng
    protected $fillable = [
        'shift_name',
        'start_time',
        'end_time',
    ];
}
