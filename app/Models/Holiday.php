<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $table = 'holidays';

    protected $fillable = [
        'title',
        'from_date',
        'to_date',
        'description',
    ];

    protected $casts = ['from_date' => 'date', 'to_date' => 'date'];

}
