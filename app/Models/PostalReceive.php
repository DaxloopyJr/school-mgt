<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostalReceive extends Model
{
    protected $table = 'postal_receives';

    protected $fillable = [
        'from_title',
        'to_title',
        'reference_no',
        'date',
        'address',
        'file',
        'note',
    ];

    protected $casts = ['date' => 'date'];

}
