<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = [
        'title',
        'description',
        'from_date',
        'to_date',
        'location',
    ];

    protected $casts = ['from_date' => 'date', 'to_date' => 'date'];

}
