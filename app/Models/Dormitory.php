<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dormitory extends Model
{
    protected $table = 'dormitories';

    protected $fillable = [
        'name',
        'type',
        'address',
        'capacity',
    ];

    protected $casts = [];

}
