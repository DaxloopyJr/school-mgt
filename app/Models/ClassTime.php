<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassTime extends Model
{
    protected $table = 'class_times';

    protected $fillable = [
        'period',
        'start_time',
        'end_time',
    ];

    protected $casts = [];

}
