<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemStore extends Model
{
    protected $table = 'item_stores';

    protected $fillable = [
        'name',
        'location',
        'description',
    ];

    protected $casts = [];

}
