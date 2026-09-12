<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $table = 'notices';

    protected $fillable = [
        'title',
        'message',
        'publish_date',
        'target',
    ];

    protected $casts = ['publish_date' => 'date'];

}
