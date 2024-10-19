<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theater extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location', 'capacity'];

    protected $primaryKey = 'theater_id';
    protected $table = 'theaters';
    public function rooms()
    {
        return $this->hasMany(Room::class, 'theater_id', 'theater_id');
    }

    public function shifts()
    {
        return $this->hasMany(Shift::class, 'theater_id', 'theater_id');
    }
}
