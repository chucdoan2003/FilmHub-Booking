<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VourcherUser extends Model
{
    use HasFactory;
    protected $table = 'vourcher_user'; // Tên bảng trong cơ sở dữ liệu
    protected $fillable = [
        'user_id', 
        'vourcher_id'
    ]; // Các trường có thể được gán
}
