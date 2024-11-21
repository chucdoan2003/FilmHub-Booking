<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $primaryKey = 'movie_id';
    protected $table = 'movies';
    protected $fillable = [
        'title',
        'description',
        'duration',
        'release_date',
        'rating',
        'poster_url',
        'director',
        'performer',
        'trailer',
    ];
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_movie', 'movie_id', 'genre_id');
    }
}
