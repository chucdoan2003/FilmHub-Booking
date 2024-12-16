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
        'status'
    ];
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_movie', 'movie_id', 'genre_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'movie_id');
    }

    public function showtimes()
    {
        return $this->hasMany(Showtime::class, 'movie_id');
    }
}
