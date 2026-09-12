<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorBook extends Model
{
    protected $table = 'visitor_books';

    protected $fillable = [
        'purpose',
        'name',
        'phone',
        'no_of_persons',
        'date',
        'in_time',
        'out_time',
        'note',
    ];

    protected $casts = ['date' => 'date'];

}
