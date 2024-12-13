<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VourcherEvent extends Model
{
    use HasFactory;
    protected $table = 'vourcher_event';

    protected $fillable = [
        'event_name',
        'vourcher_code',
	    'vourcher_name',	
	    'discount_percentage',
	    'max_discount_amount',
        'start_time',
        'end_time'
    ];
}
