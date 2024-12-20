<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id', 'id');
    }
}
