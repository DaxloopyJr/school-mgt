<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterWidget extends Model
{
    protected $table = 'footer_widgets';

    protected $fillable = [
        'title',
        'content',
        'sort_order',
    ];

    protected $casts = [];

}
