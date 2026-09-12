<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostalDispatch extends Model
{
    protected $table = 'postal_dispatches';

    protected $fillable = [
        'to_title',
        'from_title',
        'reference_no',
        'date',
        'address',
        'file',
        'note',
    ];

    protected $casts = ['date' => 'date'];

}
