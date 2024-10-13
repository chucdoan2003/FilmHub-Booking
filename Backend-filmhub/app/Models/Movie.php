<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $table = 'movies';
    protected $primaryKey = 'movie_id';
    protected $fillable = [
        'title',
        'description',
        'duration',
        'release_date',
        'genre',    
        'rating',
        'poster_url',
    ];

}
