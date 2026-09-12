<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IdCard extends Model
{
    protected $table = 'id_cards';

    protected $fillable = [
        'name',
        'title',
        'description',
    ];

    protected $casts = [];

}
